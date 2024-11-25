<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(Request $request): array
    {
        if($request->input('code')){
            $code = strtoupper($request->input('code'));
            $req_language = strtoupper($request->input('language'));
            $language_data = [];
            $countryGroupCountry = \DB::table('country_group_country')->where('country_code', $code)->first();
            if($countryGroupCountry){
                $countryGroupID = $countryGroupCountry->country_group_id;
                $countryGroupItem = \DB::table('country_groups')->where('id', $countryGroupID)->first();
                $countryGroup = $countryGroupItem->id;
            }else{
                $countryGroupItem = \DB::table('country_groups')->where('id', 1)->first();
                $countryGroup = 1;
            }
            $countryGroupLanguages = \DB::table('country_group_language')->where('country_group_id', $countryGroup)->get();
            foreach($countryGroupLanguages as $group){
                $language = \DB::table('languages')->where('id', $group->language_id)->first();
                $language_data[] = [
                    'zone_id' => $countryGroupItem->id,
                    'zone' => $countryGroupItem->code,
                    'zone_name' => $countryGroupItem->list_title,
                    'language_id' => $language->id,
                    'language_code' => $language->code,
                    'language_name' => $req_language == 'tr' ? $language->native : $language->name
                ];
            }
        }

        return $language_data;
    }

    public function getLanguagesByZone(Request $request): array
    {
        $zone = $request->input('zone');
        $languageCode = $request->input('language');
        $country_group = \DB::table('country_groups')->where('code', $zone)->first();
        $group_langauges = \DB::table('country_group_language')->where('country_group_id', $country_group->id)->get();
        $language_data = [];
        foreach( $group_langauges as $group ){
            $language = \DB::table('languages')->where('id', $group->language_id)->first();
            $language_data[] = [
                'value' => $language->code,
                'label' => $languageCode == 'tr' ? $language->native : $language->name
            ];
        }
        return $language_data;
    }

    public function getLanguagesByCountry(Request $request): array
    {
        if($request->input('country')){
            $code = strtoupper($request->input('country'));
            $languageCode = $request->input('language');
            $language_data = [];
            $countryGroupCountry = \DB::table('country_group_country')->where('country_code', $code)->first();
            if($countryGroupCountry){
                $countryGroupID = $countryGroupCountry->country_group_id;
                $countryGroupItem = \DB::table('country_groups')->where('id', $countryGroupID)->first();
                $countryGroup = $countryGroupItem->id;
            }else{
                $countryGroupItem = \DB::table('country_groups')->where('id', 1)->first();
                $countryGroup = 1;
            }
            $countryGroupLanguages = \DB::table('country_group_language')->where('country_group_id', $countryGroup)->get();
            foreach($countryGroupLanguages as $group){
                $language = \DB::table('languages')->where('id', $group->language_id)->first();
                $language_data[] = [
                    'value' => $language->code,
                    'label' => $code == 'TR' && $languageCode == 'tr' ? $language->native : $language->name
                ];
            }
        }

        return $language_data;
    }
}
