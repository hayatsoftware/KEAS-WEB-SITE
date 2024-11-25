<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function getCategories(Request $request)
    {
        $zone = $request->input('zone');
        $language_code = $request->input('language');
        $lg = \DB::table('languages')->where('code', $language_code)->first();
        $cg = \DB::table('country_groups')->where('code', $zone)->first();
        $category_id = $request->input('category_id');
        return Cache::remember('get_category_by_id_api'.$cg->code.'_'.$lg->code.'_'.$category_id, 7*24*60*60, function() use ($cg,$lg,$category_id){
            $categories = \DB::table('categories')
                ->select(
                    'categories.id',
                    'category_details.name',
                    'category_details.detail',
                    'urls.url',
                    'cover_image.mfile_id as cover_image_id',
                    'cover_detail_image.mfile_id as cover_detail_image_id',
            )
                ->join('category_details', function($join)use($cg,$lg){
                    $join->on('category_details.category_id', '=', 'categories.id')
                        ->where('category_details.name', '<>', "")
                        ->where('category_details.language_id', $lg->id)
                        ->where('category_details.country_group_id', $cg->id)
                        ->where('category_details.deleted_at', NULL);
                })
                ->join('urls', function($join){
                    $join->on('urls.model_id', '=', 'category_details.id')->where('urls.type', 'original')->where('urls.model_type', 'Mediapress\Modules\Content\Models\CategoryDetail');
                })
                ->leftJoin('mfile_general as cover_image', function($join){
                    $join->on('cover_image.model_id', '=', 'categories.id')
                        ->where('cover_image.file_key', 'cover')
                        ->where('cover_image.model_type', 'Mediapress\Modules\Content\Models\Category');
                })
                ->leftJoin('mfile_general as cover_detail_image', function($join){
                    $join->on('cover_detail_image.model_id', '=', 'category_details.id')
                        ->where('cover_detail_image.file_key', 'menu_cover_image')
                        ->where('cover_detail_image.model_type', 'Mediapress\Modules\Content\Models\CategoryDetail');
                })
                ->where('categories.sitemap_id', PRODUCT_ST_ID)
                ->where('categories.category_id', $category_id)
                ->where('categories.status', 1)
                ->orderBy('categories.id')
                ->get();

            $response = self::convertCategories($categories);
            return $response;
        });
    }

    public function getSubCategories(Request $request): array
    {
        $zone = $request->input('zone');
        $language_code = $request->input('language');
        $lg = \DB::table('languages')->where('code', $language_code)->first();
        $cg = \DB::table('country_groups')->where('code', $zone)->first();
        $category_id = $request->input('category_id');
        $categories = \DB::table('categories')
            ->select(
                'categories.id',
                'category_details.name'
            )
            ->join('category_details', function($join)use($cg,$lg){
                $join->on('category_details.category_id', '=', 'categories.id')
                    ->where('category_details.name', '<>', "")
                    ->where('category_details.name', '!=', "-")
                    ->where('category_details.language_id', $lg->id)
                    ->where('category_details.country_group_id', $cg->id)
                    ->where('category_details.deleted_at', NULL);
            })
            ->where('categories.category_id', $category_id)
            ->where('categories.status', 1)
            ->orderBy('category_details.name')
            ->get();
        $category_data = [];
        foreach($categories as $category){
            $category_data[] = [
                'id' => $category->id,
                'name' => $category->name
            ];
        }
        return $category_data;
    }

    private function convertCategories($categories): array
    {
        $category_data = [];
        foreach($categories as $category)
        {
            if( !is_null($category->cover_detail_image_id) ){
                $image = get_image($category->cover_detail_image_id);
            }elseif( !is_null($category->cover_image_id) ){
                $image = get_image($category->cover_image_id);
            }else{
                $image = asset('images/default.jpg');
            }
            $category_data[] = [
                'name' => $category->name,
                'category_id' => $category->id,
                'image' => $image
            ];
        }

        return $category_data;
    }
}
