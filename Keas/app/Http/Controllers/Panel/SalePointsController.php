<?php

namespace App\Http\Controllers\Panel;

use App\City;
use App\Http\Controllers\Controller;
use App\SalePointExtras;
use App\SalePoints;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\Sitemap;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Yajra\DataTables\Html\Builder;
use Mediapress\DataTable\TableBuilderTrait;

class SalePointsController extends Controller
{

    use TableBuilderTrait;
    public const SITEMAP_ID = 'sitemap_id';
    public const WEBSITE_ID = 'website_id';

    public function index(Builder $builder){

        $sitemap = Sitemap::with(["sitemapType", "detail"])->findOrFail(37);

        $dataTableParams = [self::WEBSITE_ID => 1, self::SITEMAP_ID => 37];
        $dataTable = $this->columns($builder, $sitemap)->ajax(route('Content.pages.ajax', $dataTableParams));

        return view('panel.sale_points.index', compact('dataTable', 'sitemap'));

    }

    public function create()
    {
        $zones = CountryGroup::whereNotIn('id', [1,6])->get();
        $categories = Page::where('sitemap_id', 35)->where('status', 1)->get();
        $types = Page::where('sitemap_id', 36)->where('status', 1)->get();
        return view('panel.sale_points.create', compact('zones', 'categories', 'types'));
    }

    public function edit(SalePoints $salePoint)
    {

        $zones = CountryGroup::whereNotIn('id', [1,6])->get();
        $categories = Page::where('sitemap_id', 35)->where('status', 1)->get();
        $types = Page::where('sitemap_id', 36)->where('status', 1)->get();
        $zone_id = $salePoint->zone_id;
        if( $zone_id == 7 ){
            $cities = City::where('country_group' , 'tr')->orderBy('slug')->get()->toArray();
        }
        if( $zone_id == 4 || $zone_id == 5 ){
            $cities = City::where('country_group' , 'ru')->orderBy('slug')->get()->toArray();
        }
        if( $zone_id == 3 ){
            $cities = City::where('country_group' , 'ro')->orderBy('slug')->get()->toArray();
        }
        if( $zone_id == 2 ){
            $cities = City::where('country_group' , 'bg')->orderBy('slug')->get()->toArray();
        }

        return view('panel.sale_points.edit', compact('zones', 'categories', 'types', 'salePoint', 'cities'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'zone_id' => 'required',
            'categories' => 'required',
            'types' => 'required',
            'native_name' => 'required',
            'localized_name' => 'required',
            'city' => 'required',
            'cords' => 'required',
            'native_address' => 'required',
            'localized_address' => 'required',
        ]);
        $zone_id = $request->input('zone_id');
        if( $zone_id == 7 ){
            $cities = City::where('country_group' , 'tr')->orderBy('slug')->get();
        }
        if( $zone_id == 4 || $zone_id == 5 ){
            $cities = City::where('country_group' , 'ru')->orderBy('slug')->get();
        }
        if( $zone_id == 3 ){
            $cities = City::where('country_group' , 'ro')->orderBy('slug')->get();
        }
        if( $zone_id == 2 ){
            $cities = City::where('country_group' , 'bg')->orderBy('slug')->get();
        }
        $city = $request->input('city');
        $cityData = $cities->where('slug', $city)->first();
        $create_data = [
            'native_name' => $request->input('native_name'),
            'localized_name' => $request->input('localized_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'native_city' => $cityData['en'],
            'localized_city' => $cityData['native'],
            'city_slug' => $city,
            'native_address' => $request->input('native_address'),
            'localized_address' => $request->input('localized_address'),
            'cords' => $request->input('cords'),
            'zone_id' => $zone_id,
            'status' => 1,
            'country' => $request->input('country')
        ];
        $sale_point = SalePoints::create($create_data);
        if( $sale_point ){
            $categories = $request->input('categories');
            foreach( $categories as $category ){
                SalePointExtras::create([
                   'sale_points_id' => $sale_point->id,
                   'key' => 'category',
                   'value' => $category
                ]);
            }

            $types = $request->input('types');
            foreach( $types as $type ){
                SalePointExtras::create([
                    'sale_points_id' => $sale_point->id,
                    'key' => 'type',
                    'value' => $type
                ]);
            }
        }
        return redirect()->route('panel.sale_points.index');
    }

    public function update(Request $request)
    {

        $request->validate([
            'zone_id' => 'required',
            'categories' => 'required',
            'types' => 'required',
            'native_name' => 'required',
            'localized_name' => 'required',
            'city' => 'required',
            'cords' => 'required',
            'native_address' => 'required',
            'localized_address' => 'required',
            'sale_point_id' => 'required'
        ]);
        $zone_id = $request->input('zone_id');
        if( $zone_id == 7 ){
            $cities = City::where('country_group' , 'tr')->orderBy('slug')->get();
        }
        if( $zone_id == 4 || $zone_id == 5 ){
            $cities = City::where('country_group' , 'ru')->orderBy('slug')->get();
        }
        if( $zone_id == 3 ){
            $cities = City::where('country_group' , 'ro')->orderBy('slug')->get();
        }
        if( $zone_id == 2 ){
            $cities = City::where('country_group' , 'bg')->orderBy('slug')->get();
        }
        $city = $request->input('city');
        $cityData = $cities->where('slug', $city)->first();
        $update_data = [
            'native_name' => $request->input('native_name'),
            'localized_name' => $request->input('localized_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'native_city' => $cityData['en'],
            'localized_city' => $cityData['native'],
            'city_slug' => $city,
            'native_address' => $request->input('native_address'),
            'localized_address' => $request->input('localized_address'),
            'cords' => $request->input('cords'),
            'zone_id' => $zone_id,
            'country' => $request->input('country'),
            'status' => 1
        ];
        $id = $request->input('sale_point_id');
        $sale_point = SalePoints::where('id', $id)->update($update_data);
        if( $sale_point ){
            SalePointExtras::where('sale_points_id', $id)->delete();
            $categories = $request->input('categories');
            foreach( $categories as $category ){
                SalePointExtras::create([
                    'sale_points_id' => $id,
                    'key' => 'category',
                    'value' => $category
                ]);
            }

            $types = $request->input('types');
            foreach( $types as $type ){
                SalePointExtras::create([
                    'sale_points_id' => $id,
                    'key' => 'type',
                    'value' => $type
                ]);
            }
        }
        return redirect()->route('panel.sale_points.index');
    }

    public function delete(SalePoints $salePoint)
    {

        SalePointExtras::where('sale_points_id', $salePoint->id)->delete();
        $salePoint->delete();
        return redirect()->route('panel.sale_points.index');
    }

    public function getCityByCountryId(Request $request): JsonResponse
    {
        $zone_data = [];
        $zone_id = $request->input('zone_id');
        if( $zone_id == 7 ){
            $cities = City::where('country_group' , 'tr')->orderBy('slug')->get()->toArray();
        }
        if( $zone_id == 4 || $zone_id == 5 ){
            $cities = City::where('country_group' , 'ru')->orderBy('slug')->get()->toArray();
        }
        if( $zone_id == 3 ){
            $cities = City::where('country_group' , 'ro')->orderBy('slug')->get()->toArray();
        }
        if( $zone_id == 2 ){
            $cities = City::where('country_group' , 'bg')->orderBy('slug')->get()->toArray();
        }
        foreach($cities as $zone)
        {
            $zone_data[] = [
                'value' => \Str::slug($zone['en'], '-'),
                'name' => $zone['en']
            ];
        }
        return response()->json($zone_data);
    }

    public function importView()
    {
        $sitemap = Sitemap::with(["sitemapType", "detail"])->findOrFail(37);
        return view('panel.sale_points.import', compact('sitemap'));
    }

    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {
         Excel::import(new \App\Imports\SalePoints(), $request->file('sale_points'));
         return redirect()->back()->with('success', 'Records imported successfully');
    }

    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new \App\Exports\SalePoints(), 'sale_points.xlsx');
    }
}
