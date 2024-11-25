<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Controllers\Controller;
use App\SalePoints;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\Language;

class SalePointsController extends Controller
{
    public function getData(Request $request): array
    {
        $language_code = $request->input('language');
        $country_group_code = $request->input('zone');
        $language = \DB::table('languages')->where('code', $language_code)->first();
        $country_group = \DB::table('country_groups')->where('code', $country_group_code)->first();
        $country_data = [];
        $country_ids = \DB::table('sale_points')->where('zone_id', $country_group->id)->pluck('country')->unique();
        $countries = \DB::table('countries')->whereIn('id', $country_ids)->orderBy('native')->get();
        foreach($countries as $country){
            if($language->code == 'tr'){
                $country_name = $country->tr;
            }else{
                if( $language->code == 'en' ){
                    $country_name = $country->en;
                }else{
                    $key = \Str::slug($country->en);
                    $country_translation = \DB::table('language_parts')->where('country_group_id', $country_group->id)->where('language_id', $language->id)->where('key', $key)->first();
                    $country_name = !is_null($country_translation) ? !is_null($country_translation->value) ? $country_translation->value : $country->en : $country->en;
                }
            }
            $country_data[] = [
                'label' => $country_name,
                'value' => $country->id
            ];
        }
        $return_data['countries'] = $country_data;
        if( $country_group->id == 6 || $country_group->id == 1 ){
            $agents = Page::whereSitemapId(SALE_AGENTS_ST_ID)->where('status', 1)->orderBy('order')->get();
            $return_data['agents'] = self::convertSaleAgents($agents);

        }else{
            $sale_points = SalePoints::where('zone_id', $country_group->id)->get()->pluck('id');
            $dealerTypeIds = self::getDealerTypeIds($sale_points);
            $dealerCategoryIds = self::getDealerCategoryIds($sale_points);

            $products = self::getPages($dealerCategoryIds, $country_group, $language);
            $dealer_types = self::getPages($dealerTypeIds, $country_group, $language);
            $return_data['products'] = $products;
            $return_data['dealer_types'] = $dealer_types;
        }
        return $return_data;
    }

    public function getCities(Request $request): array
    {
        $language_code = $request->input('language');
        $country_group_code = $request->input('zone');
        $country_group = \DB::table('country_groups')->where('code', $country_group_code)->first();
        $country = $request->input('country');
        $sale_points = \DB::table('sale_points')
            ->where('country', $country)
            ->where('zone_id', $country_group->id)
            ->get()
            ->unique('city_slug');
        $city_data = [];
        foreach($sale_points as $point){
            $city_data[] = [
                'label' => $language_code == 'en' ? $point->native_city : $point->localized_city,
                'value' => $point->city_slug
            ];
        }
        return collect($city_data)->sortBy('label')->values()->toArray();
    }

    public function getSalePoints(Request $request): array
    {
        $city = $request->input('city');
        $category = $request->input('product');
        $type = $request->input('type');
        $q = $request->input('q');
        $cg = $request->input('zone');
        $lg = $request->input('language');
        $sale_points_data = [];

        $country_group = CountryGroup::where('code', $cg)->first();
        $language = Language::where('code', $lg)->first();
        $sale_points = SalePoints::where('zone_id', $country_group->id)
            ->when($category, function($query)use($category){
                return $query->whereHas('extras', function($q)use($category){
                    return $q->where('key', 'category')->where('value', $category);
                });
            })
            ->when($type, function($query)use($type){
                return $query->whereHas('extras', function($q)use($type){
                    return $q->where('key', 'type')->where('value', $type);
                });
            })
            ->when($city, function($query)use($city){
                return $query->where('city_slug', $city);
            })
            ->when($q, function($query)use($q){
                return $query->where('native_name', 'like', $q.'%')->orWhere('localized_name', 'like', $q.'%');
            })
            ->paginate(10);
        foreach($sale_points as $point){
            $cords = explode(',', $point->cords);
            $name = $lg == 'en' ? $point->native_name : $point->localized_name;
            $sale_points_data[] = [
                'id' => $point->id,
                'name' => $name,
                'city' => $lg == 'en' ? $point->native_city : $point->localized_city,
                'address' => $lg == 'en' ? $point->native_address : $point->localized_address,
                'phone' => $point->phone,
                'email' => $point->email,
                'website' => $point->website,
                'cords' => $cords,
                'lat' => isset($cords[0]) ? floatval(str_replace(" ","", $cords[0])) : null,
                'lng' => isset($cords[1]) ? floatval(str_replace(" ","", $cords[1])) : null,
                'slug' => \Str::slug($name, '-')
            ];
        }

        if($sale_points->isNotEmpty()){
            return [
                'status' => 1,
                'points' => $sale_points_data,
                'current_page' => $sale_points->currentPage(),
                'last_page' => $sale_points->lastPage()
            ];
        }else{
            return [
                'status' => 0
            ];
        }
    }

    private function convertSaleAgents($agents): array
    {
        $sale_agents_data = [];

        foreach($agents as $agent){

            if( $agent->detail ){
                $sale_agents_data[] = [
                    'name' => $agent->detail->name,
                    'service' => $agent->detail->summary,
                    'phone' => $agent->cvar_1,
                    'email' => $agent->cvar_2
                ];
            }

        }

        return $sale_agents_data;
    }

    private function getDealerTypeIds($sale_point_ids): array
    {
        $data = [];
        $ids = \DB::table('sale_points_extras')
            ->select('sale_points_extras.value')
            ->where('sale_points_extras.key', 'type')
            ->whereIn('sale_points_extras.sale_points_id', $sale_point_ids)
            ->get()
            ->unique()
            ->values();
        foreach($ids as $id){
            array_push($data, $id->value);
        }
        return $data;
    }

    private function getDealerCategoryIds($sale_point_ids): array
    {
        $data = [];
        $ids = \DB::table('sale_points_extras')
            ->select('sale_points_extras.value')
            ->where('sale_points_extras.key', 'category')
            ->whereIn('sale_points_extras.sale_points_id', $sale_point_ids)
            ->get()
            ->unique()
            ->values();
        foreach($ids as $id){
            array_push($data, $id->value);
        }
        return $data;
    }

    private function getPages($ids, $zone, $language)
    {
        $pages = \DB::table('pages')
            ->select('pages.id', 'page_details.name')
            ->join('page_details', function($join)use($zone,$language){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('page_details.name', '!=', NULL)
                            ->where('page_details.name', '!=', '-');
                    })
                    ->where('page_details.language_id', $language->id)
                    ->where('page_details.country_group_id', $zone->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->where('pages.status', 1)
            ->whereIn('pages.id', $ids)
            ->get();
        $return_data = [];
        foreach($pages as $page){
            $return_data[] = [
                'value' => $page->id,
                'label' => $page->name
            ];
        }
        return $return_data;
    }
}
