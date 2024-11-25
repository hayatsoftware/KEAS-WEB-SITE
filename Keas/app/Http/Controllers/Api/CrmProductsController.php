<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CrmProductsController extends Controller
{
    public function index(Request $request)
    {
        $zone = $request->input('zone');
        $language_code = $request->input('language');
        $language = \DB::table('languages')->where('code', $language_code)->first();
        $country_group = \DB::table('country_groups')->where('code', $zone)->first();
        $products = \DB::table('pages')
            ->select('pages.cint_1 as value', 'page_details.name as label')
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
            ->where('pages.sitemap_id', CRM_PREFERRED_PRODUCTS_ST_ID)
            ->orderBy('value')
            ->get()
            ->toArray();
        return $products;
    }
}
