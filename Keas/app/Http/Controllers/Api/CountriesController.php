<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    /*
     * @return array|data
     */
    public function index(Request $request):array
    {
        $data = [];
        $countries =  \DB::table('countries')->orderBy('native')->get();
        $language = $request->input('language');
        foreach($countries as $country){
            $data[] = [
                'value' => $country->code,
                'label' => $language == 'tr' ? $country->tr : $country->native,
            ];
        }
        return $data;
    }

    public function getCountriesList(Request $request):array
    {
        $data = [];
        $language = $request->input('language');
        $countries =  \DB::table('countries')->orderBy('native')->get();
        foreach($countries as $country){
            $data[] = [
                'value' => $country->code,
                'label' => $language == 'tr' ? $country->tr : $country->native,
            ];
        }
        return $data;
    }

    public function getCountriesListTurkishValue(Request $request):array
    {
        $data = [];
        $language = $request->input('language');
        $countries =  \DB::table('countries')->orderBy('native')->get();
        foreach($countries as $country){
            $data[] = [
                'value' => $country->tr,
                'label' => $language == 'tr' ? $country->tr : $country->native,
            ];
        }
        return $data;
    }

    public function getZoneInfo(Request $request){
        $country = $request->input('country');
        $country_group_country = \DB::table('country_group_country')->where('country_code', $country)->first();
        if($country_group_country){
            $country_group = \DB::table('country_groups')->where('id', $country_group_country->country_group_id)->first();
            return [
                'status' => 1,
                'zone' => $country_group->code
            ];
        }else{
            return [
                'status' => 1,
                'zone' => 'gl'
            ];
        }

    }
}
