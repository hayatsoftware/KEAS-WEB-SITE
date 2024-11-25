<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\Page;

class BrandController extends Controller
{
    public function index(Request $request): \Illuminate\Support\Collection
    {
        $zone = $request->input('zone');
        $language_code = $request->input('language');
        $lg = \DB::table('languages')->where('code', $language_code)->first();
        $cg = \DB::table('country_groups')->where('code', $zone)->first();
        $category_id = $request->input('category_id');
        $category = Category::find($category_id);
        if($category){
            if($category->id == 5 || $category->category_id == 5 ){
                $detail_ids = getPagesDetailsIds($category_id, $cg, $lg);
                $brand_ids = \DB::table('page_detail_extras')->where('key', 'brand')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
            }else{
                $brand_ids = self::getCategoryPagesByCintOne($category);
            }
            $brands = self::getPages($brand_ids, $cg, $lg);
            foreach( $brands as $brand ){
                $brand_data[] = [
                    'id' => $brand->id,
                    'name' => $brand->name
                ];
            }
        }
        $brand_data = collect($brand_data)->sortBy('name')->values();
        return $brand_data;
    }

    private function getPages($brand_ids, $cg, $lg)
    {
        return \DB::table('pages')
            ->select(
                'pages.cint_1 as id',
                'page_details.name as name'
            )
            ->join('page_details', function($join)use($cg,$lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '<>', "")
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->where('pages.sitemap_id', BRANDS_ST_ID)
            ->whereIn('pages.cint_1', $brand_ids)
            ->where('pages.status', 1)
            ->get();
    }


    private function getCategoryPagesByCintOne($category)
    {

        if( ($category->category_id == 1 && $category->id != 14) || $category->category_id == 15 ){
            $category_ids = $category->children()->pluck('id')->unique();
        }else{
            $category_ids = array($category->id);
        }

        $category_pages = Page::where('sitemap_id', PRODUCT_ST_ID)
            ->where('status', 1)
            ->whereHas('categories', function($query)use($category_ids){
                return $query->whereIn('id', $category_ids);
            })
            ->whereNotNull('cint_1')
            ->get()
            ->pluck('cint_1')
            ->unique();
        return $category_pages;
    }
}
