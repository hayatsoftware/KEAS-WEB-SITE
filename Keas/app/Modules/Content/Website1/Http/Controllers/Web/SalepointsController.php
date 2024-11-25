<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use App\City;
use App\SalePoints;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\Language;

class SalepointsController extends BaseController
{
    public function SitemapDetail(Mediapress $mediapress) {
        $mediapress->data['sitemap'] = $mediapress->sitemap;
        $mediapress->data['page'] = $mediapress->parent;
        $country_data = \DB::table('sale_points')->where('zone_id', $mediapress->activeCountryGroup->id)->pluck('country')->unique();
        $countries = \DB::table('countries')->whereIn('id', $country_data)->orderBy('native')->get()->toArray();
        $mediapress->data['countries'] = $countries;
        if( $mediapress->activeCountryGroup->id == 6 || $mediapress->activeCountryGroup->id == 1 ){
            $agents = Page::whereSitemapId(SALE_AGENTS_ST_ID)->where('status', 1)->orderBy('order')->get()->groupBy('cvar_3');
            $mediapress->data['agents'] = $agents;
            return view('web.pages.salepoints.page_template_two', compact('mediapress'));
        }else{
            $sale_points = SalePoints::where('zone_id', $mediapress->activeCountryGroup->id)->get()->pluck('id');
            $dealerTypeIds = self::getDealerTypeIds($sale_points);
            $dealerCategoryIds = self::getDealerCategoryIds($sale_points);

            $mediapress->data['categories'] = Page::whereIn('id', $dealerCategoryIds)->where('status', 1)->get();
            $mediapress->data['dealer_types'] = Page::whereIn('id', $dealerTypeIds)->where('status', 1)->get();
            $mediapress->data['points'] = SalePoints::where('zone_id', $mediapress->activeCountryGroup->id)->where('status', 1)->get();
            return view('web.pages.salepoints.page', compact('mediapress'));
        }
	}

    public function getCities(Request $request): JsonResponse
    {
        $country = $request->input('country');
        $zone = $request->input('zone');
        $language = $request->input('language');
        $country_group = \DB::table('country_groups')->where('id', $zone)->first();
        $sale_points = \DB::table('sale_points')
            ->where('country', $country)
            ->where('zone_id', $zone)
            ->get()
            ->unique('city_slug');
        $city_data = [];
        foreach($sale_points as $point){
            $city_record = \DB::table('cities')->where('slug', $point->city_slug)->where('country_group', $country_group->code)->first();
            if($city_record){
                $city_data[] = [
                    'name' => $language == 'en' ? $city_record->en : $city_record->native,
                    'slug' => $city_record->slug
                ];
            }

        }
        $city_data_result = collect($city_data)->sortBy('name')->values();
        return response()->json($city_data_result);
    }

    public function getSalePoints(Mediapress $mediapress,Request $request): JsonResponse
    {
        $country = $request->input('country');
        $city = $request->input('city');
        $category = $request->input('category');
        $type = $request->input('type');
        $q = $request->input('q');
        $firstLoad = $request->input('firstLoad');
        $cg = $request->input('cg');
        $lg = $request->input('lg');
        $sale_points_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($cg);
        $mediapress->activeLanguage = Language::where('code', $lg)->first();
        $sale_points = SalePoints::where('zone_id', $cg)
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
            ->when($country, function($query)use($country){
                return $query->where('country', $country);
            })
            ->when($q, function($query)use($q){
                return $query->where('native_name', 'like', $q.'%')->orWhere('localized_name', 'like', $q.'%');
            })
            ->get();
        foreach($sale_points as $point){
            $cords = explode(',', $point->cords);
            $sale_points_data[$point->id] = [
                'id' => $point->id,
                'name' => $lg == 'en' ? $point->native_name : $point->localized_name,
                'city' => $lg == 'en' ? $point->native_city : $point->localized_city,
                'address' => $lg == 'en' ? $point->native_address : $point->localized_address,
                'phone' => $point->phone,
                'email' => $point->email,
                'website' => $point->website,
                'cords' => $cords,
                'lat' => isset($cords[0]) ? floatval(str_replace(" ","", $cords[0])) : null,
                'lng' => isset($cords[1]) ? floatval(str_replace(" ","", $cords[1])) : null
            ];
            $sale_points_data[$point->id]['slug'] = \Str::slug($sale_points_data[$point->id]['name'], '-');
        }
        $sale_points_data = collect($sale_points_data)->sortBy('slug');
        $render = view('web.pages.salepoints.render', ['points'=>$sale_points_data])->render();
        if($sale_points->isNotEmpty()){
            return response()->json([
                'points' => $sale_points_data,
                'render' => $render,
                'status' => 1
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'msg' => strip_tags(LangPart('not_found_sale_points', 'Herhangi bir sonuç bulunamadı.'))
            ]);
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


}
