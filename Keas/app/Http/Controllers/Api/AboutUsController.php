<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        $language_code = $request->input('language_id');
        $country_group_code = $request->input('zone');
        $language = \DB::table('languages')->where('code', $language_code)->first();
        $country_group = \DB::table('country_groups')->where('code', $country_group_code)->first();
        $page = \DB::table('pages')
            ->select('pages.id', 'page_details.id as page_detail_id', 'page_details.name', 'about_us.value as detail')
            ->join('page_details', function($join)use($language, $country_group){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('page_details.name', '!=', NULL)
                            ->where('page_details.name', '!=', '-');
                    })
                    ->where('page_details.language_id', $language->id)
                    ->where('page_details.country_group_id', $country_group->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->join('page_detail_extras as about_us', function($join){
                $join->on('about_us.page_detail_id', '=', 'page_details.id')
                    ->where('key', 'app_about_us');
            })
            ->first();

        return [
            'title' => $page->name,
            'detail' => convert_images_from_content($page->detail)
        ];
    }
}
