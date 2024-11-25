<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KvkkController extends Controller
{
    public function index(Request $request){
        $language_code = $request->input('language');
        $country_group_code = $request->input('zone');
        $language = \DB::table('languages')->where('code', $language_code)->first();
        $country_group = \DB::table('country_groups')->where('code', $country_group_code)->first();
        $kvkk = \DB::table('sitemaps')
            ->select('sitemaps.id', 'sitemap_details.name', 'sitemap_details.detail', 'contact_text.value as contact_text', 'kvkk_text.value as kvkk_text')
            ->join('sitemap_details', function($join)use($language, $country_group){
                $join->on('sitemap_details.sitemap_id', '=', 'sitemaps.id')
                    ->where(function($query){
                        return $query->where('sitemap_details.name', '!=', NULL)
                            ->where('sitemap_details.name', '!=', '-');
                    })
                    ->where('sitemap_details.language_id', $language->id)
                    ->where('sitemap_details.country_group_id', $country_group->id)
                    ->where('sitemap_details.deleted_at', NULL);
            })
            ->join('sitemap_detail_extras as contact_text', function($join){
                $join->on('contact_text.sitemap_detail_id', '=', 'sitemap_details.id')
                    ->where('contact_text.key', 'contact_text');
            })
            ->join('sitemap_detail_extras as kvkk_text', function($join){
                $join->on('kvkk_text.sitemap_detail_id', '=', 'sitemap_details.id')
                    ->where('kvkk_text.key', 'kvkk');
            })
            ->where('sitemaps.id', REGISTER_ST_ID)
            ->first();

        return [
            'title' => $kvkk->name,
            'kvkk' => $kvkk->kvkk_text,
            'contact_text' => $kvkk->contact_text
        ];
    }
}
