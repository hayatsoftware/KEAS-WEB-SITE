<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\PageDetail;
use Mediapress\Modules\Content\Models\Sitemap;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\Language;

class ProductsController extends Controller
{
    private $selects = [
        'pages.id',
        'pages.cint_1 as brand',
        'pages.cint_3 as decor_code',
        'pages.cint_5 as active_online',
        'pages.cint_4',
        'pages.cvar_2',
        'pages.order',
        'page_details.id as page_detail_id',
        'page_details.name',
        'page_details.detail',
        'categories.id as category_id',
        'category_details.name as category_details_name',
        'decor_image.mfile_id as decor_image_id',
        'page_detail_extras_usage_area.value as usage_area',
        'page_detail_extras_three_d.value as three_d'
    ];
    public function index(Mediapress $mediapress,Request $request)
    {
        $zone = $request->input('zone');
        $language_code = $request->input('language');
        $lg = \DB::table('languages')->where('code', $language_code)->first();
        $cg = \DB::table('country_groups')->where('code', $zone)->first();
        $mediapress->activeCountryGroup = CountryGroup::find($cg->id);
        $mediapress->activeLanguage = Language::find($lg->id);
        $filter = $request->input('filters');
        $category_id = $request->input('category_id');
        $parke_categories = [15,16,41,60,64,72];

        $products = \DB::table('pages')
            ->select($this->selects)
            ->join('page_details', function($join)use($cg,$lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '<>', "")
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->join('category_page', function($join){
                $join->on('category_page.page_id', '=', 'pages.id');
            })
            ->join('categories', function($join)use($category_id, $filter){
                $join->on('categories.id', '=' ,'category_page.category_id')
                    ->when(count($filter['categories']) > 0, function($query)use($filter){
                        return $query->whereIn('categories.id', $filter['categories']);
                    })
                    ->when($category_id == 14 && count($filter['categories']) < 1, function($query)use($category_id){
                        return $query->where('categories.id', $category_id);
                    })
                    ->when($category_id != 14 && count($filter['categories']) < 1, function($query)use($category_id){
                        return $query->where('categories.category_id', $category_id);
                    });

            })
            ->join('category_details', function($join) use($cg,$lg) {
                $join->on('category_details.category_id', '=', 'categories.id');
                $join->where('category_details.language_id', $lg->id)
                    ->where('category_details.country_group_id', $cg->id);
            })
            ->leftJoin('page_detail_extras as page_detail_extras_usage_area', function($join){
                $join->on('page_detail_extras_usage_area.page_detail_id', '=', 'page_details.id')
                    ->where('page_detail_extras_usage_area.key', 'usage_area');
            })
            ->leftJoin('page_detail_extras as page_detail_extras_three_d', function($join){
                $join->on('page_detail_extras_three_d.page_detail_id', '=', 'page_details.id')
                    ->where('page_detail_extras_three_d.key', 'threedparams');
            })
            ->when(count($filter['brands']) > 0 && ( $category_id != 14 && $category_id != 11 ), function($query)use($filter){
                return $query->join('page_detail_extras as page_detail_extras_brand', function($join)use($filter){
                    $join->on('page_detail_extras_brand.page_detail_id', '=', 'page_details.id')
                        ->where('page_detail_extras_brand.key', 'brand')
                        ->whereIn('page_detail_extras_brand.value', $filter['brands']);
                });
            })
            ->when(count($filter['brands']) > 0 && ( $category_id == 14 || $category_id == 11), function($query)use($filter){
                return $query->whereIn('pages.cint_1', $filter['brands']);
            })
            ->when(count($filter['decors']) > 0 && !in_array($category_id, $parke_categories), function($query)use($filter){
                return $query->join('page_detail_extras as page_detail_extras_decors', function($join)use($filter){
                    $join->on('page_detail_extras_decors.page_detail_id', '=', 'page_details.id')
                        ->where('page_detail_extras_decors.key', 'decor')
                        ->whereIn('page_detail_extras_decors.value', $filter['decors']);
                });
            })
            ->when(count($filter['decors']) > 0 && in_array($category_id, $parke_categories), function($query)use($filter){
                return $query->join('page_extras as page_extras_decors', function($join)use($filter){
                    $join->on('page_extras_decors.page_id', '=', 'pages.id')
                        ->where('page_extras_decors.key', 'decor')
                        ->whereIn('page_extras_decors.value', $filter['decors']);
                });
            })
            ->when(count($filter['surfaces']) > 0 && !in_array($category_id, $parke_categories), function($query)use($filter){
                return $query->join('page_detail_extras as page_detail_extras_surfaces', function($join)use($filter){
                    $join->on('page_detail_extras_surfaces.page_detail_id', '=', 'page_details.id')
                        ->where('page_detail_extras_surfaces.key', 'surface')
                        ->whereIn('page_detail_extras_surfaces.value', $filter['surfaces']);
                });
            })
            ->when(count($filter['surfaces']) > 0 && in_array($category_id, $parke_categories), function($query)use($filter){
                return $query->join('page_extras as page_extras_surfaces', function($join)use($filter){
                    $join->on('page_extras_surfaces.page_id', '=', 'pages.id')
                        ->where('page_extras_surfaces.key', 'surface')
                        ->whereIn('page_extras_surfaces.value', $filter['surfaces']);
                });
            })
            ->when(count($filter['extra_features']) > 0, function($query)use($filter){
                return $query->join('page_detail_extras as page_detail_extras_extra_features', function($join)use($filter){
                    $join->on('page_detail_extras_extra_features.page_detail_id', '=', 'page_details.id')
                        ->where('page_detail_extras_extra_features.key', 'extra_feature')
                        ->whereIn('page_detail_extras_extra_features.value', $filter['extra_features']);
                });
            })
            ->when(count($filter['dimensions']) > 0, function($query)use($filter){
                return $query->join('page_detail_extras as page_detail_extras_dimensions', function($join)use($filter){
                    $join->on('page_detail_extras_dimensions.page_detail_id', '=', 'page_details.id')
                        ->where('page_detail_extras_dimensions.key', 'dimension')
                        ->whereIn('page_detail_extras_dimensions.value', $filter['dimensions']);
                });
            })
            ->when(count($filter['textures']) > 0, function($query)use($filter){
                return $query->join('page_detail_extras as page_detail_extras_textures', function($join)use($filter){
                    $join->on('page_detail_extras_textures.page_detail_id', '=', 'page_details.id')
                        ->where('page_detail_extras_textures.key', 'texture')
                        ->whereIn('page_detail_extras_textures.value', $filter['textures']);
                });
            })
            ->when(count($filter['thicknesses']) > 0, function($query)use($filter){
                return $query->join('page_extras as page_extras_thicknesses', function($join)use($filter){
                    $join->on('page_extras_thicknesses.page_id', '=', 'pages.id')
                        ->where('page_extras_thicknesses.key', 'thickness')
                        ->whereIn('page_extras_thicknesses.value', $filter['thicknesses']);
                });
            })
            ->when(count($filter['locks']) > 0, function($query)use($filter){
                return $query->join('page_extras as page_extras_locks', function($join)use($filter){
                    $join->on('page_extras_locks.page_id', '=', 'pages.id')
                        ->where('page_extras_locks.key', 'lock')
                        ->whereIn('page_extras_locks.value', $filter['locks']);
                });
            })
            ->when(count($filter['classes']) > 0, function($query)use($filter){
                return $query->join('page_extras as page_extras_classes', function($join)use($filter){
                    $join->on('page_extras_classes.page_id', '=', 'pages.id')
                        ->where('page_extras_classes.key', 'class')
                        ->whereIn('page_extras_classes.value', $filter['classes']);
                });
            })
            ->when(count($filter['bevels']) > 0, function($query)use($filter){
                return $query->join('page_extras as page_extras_bevels', function($join)use($filter){
                    $join->on('page_extras_bevels.page_id', '=', 'pages.id')
                        ->where('page_extras_bevels.key', 'bevel')
                        ->whereIn('page_extras_bevels.value', $filter['bevels']);
                });
            })
            ->when(count($filter['heights']) > 0, function($query)use($filter){
                return $query->join('page_extras as page_extras_heights', function($join)use($filter){
                    $join->on('page_extras_heights.page_id', '=', 'pages.id')
                        ->where('page_extras_heights.key', 'height')
                        ->whereIn('page_extras_heights.value', $filter['heights']);
                });
            })
            ->leftJoin('mfile_general as decor_image', function($join){
                $join->on('decor_image.model_id', '=', 'pages.id')->where('decor_image.file_key', 'cover')->where('decor_image.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->where('pages.sitemap_id', PRODUCT_ST_ID)
            ->where('pages.status', 1)
            ->orderBy('order')
            ->groupBy('pages.id')
            ->paginate(10);
        if($products->isNotEmpty()){
            $product_data = self::convertProducts($products, $category_id, $cg, $lg);
            return [
                'status' => 1,
                'data' => $product_data,
                'category' => self::getCategory($category_id, $cg, $lg),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage()
            ];
        }else{
            return [
                'status' => 0,
                'data' => [],
                'category' => self::getCategory($category_id, $cg, $lg),
            ];
        }

    }

    public function product(Request $request)
    {
        $zone = $request->input('zone');
        $language_code = $request->input('language');
        $lg = \DB::table('languages')->where('code', $language_code)->first();
        $cg = \DB::table('country_groups')->where('code', $zone)->first();
        $product_id = $request->input('product_id');
        $category_id = $request->input('category_id');
        $product = \DB::table('pages')
            ->select([
                'pages.id',
                'pages.cint_1 as brand',
                'pages.cint_3 as decor_code',
                'pages.cint_5 as active_online',
                'pages.cint_4',
                'pages.cvar_2',
                'pages.order',
                'page_details.id as page_detail_id',
                'page_details.name',
                'page_details.detail',
                'page_detail_extras_usage_area.value as usage_area',
                'page_detail_extras_three_d.value as three_d',
                'decor_image.mfile_id as decor_image_id'
            ])
            ->join('page_details', function($join)use($cg,$lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '<>', "")
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->leftJoin('page_detail_extras as page_detail_extras_usage_area', function($join){
                $join->on('page_detail_extras_usage_area.page_detail_id', '=', 'page_details.id')
                    ->where('page_detail_extras_usage_area.key', 'usage_area');
            })
            ->leftJoin('page_detail_extras as page_detail_extras_three_d', function($join){
                $join->on('page_detail_extras_three_d.page_detail_id', '=', 'page_details.id')
                    ->where('page_detail_extras_three_d.key', 'threedparams');
            })
            ->leftJoin('mfile_general as decor_image', function($join){
                $join->on('decor_image.model_id', '=', 'pages.id')->where('decor_image.file_key', 'cover')->where('decor_image.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->where('pages.sitemap_id', PRODUCT_ST_ID)
            ->where('pages.status', 1)
            ->where('pages.id', $product_id)
            ->first();
        if($product){
            return [
                'status' => 1,
                'product' => $this->getProductData($product, $category_id, $cg, $lg)
            ];
        }
        return [
            'status' => 0
        ];
    }

    public function searchProduct(Request $request)
    {
        $zone = $request->input('zone');
        $language_code = $request->input('language');
        $lg = \DB::table('languages')->where('code', $language_code)->first();
        $cg = \DB::table('country_groups')->where('code', $zone)->first();
        $term = $request->input('term');
        $products = \DB::table('pages')
            ->select([
                'pages.id',
                'pages.cint_1 as brand',
                'pages.cint_3 as decor_code',
                'pages.cint_5 as active_online',
                'pages.cint_4',
                'pages.order',
                'page_details.id as page_detail_id',
                'page_details.name',
                'decor_image.mfile_id as decor_image_id',
            ])
            ->join('page_details', function($join)use($cg,$lg,$term){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '<>', "")
                    ->where(function($query)use($term){
                        $query->where('page_details.name', 'like', $term.'%')->orWhere('cint_3', $term);
                    })
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->leftJoin('mfile_general as decor_image', function($join){
                $join->on('decor_image.model_id', '=', 'pages.id')->where('decor_image.file_key', 'cover')->where('decor_image.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->where('pages.sitemap_id', PRODUCT_ST_ID)
            ->where('pages.status', 1)
            ->orderBy('order')
            ->get();
        if($products->isNotEmpty()){
            $product_data = self::convertProduct($products, $cg, $lg);
            return [
                'status' => 1,
                'data' => $product_data
            ];
        }else{
            return [
                'status' => 0,
                'data' => [],
            ];
        }
    }

    public function getFilters(Request $request)
    {
        $zone = $request->input('zone');
        $language_code = $request->input('language');
        $category_id = $request->input('category_id');
        $parke_categories = [15,16,41,60,64,72];
        return Cache::remember('get_api_products_filter'.$zone.'_'.$language_code.'_'.$category_id, 7*24*60*60, function()use($zone,$language_code,$category_id, $parke_categories){
            $lg = \DB::table('languages')->where('code', $language_code)->first();
            $cg = \DB::table('country_groups')->where('code', $zone)->first();
            $category = Category::find($category_id);
            $detail_ids = getPagesDetailsIds($category_id,$cg,$lg);
            $page_ids = getPagesIdsFilter($category,$cg,$lg);
            return [
                'dimensions' => !in_array($category_id, $parke_categories) ? $this->getDimensions($detail_ids) : [],
                'thicknesses' => $this->getThickness($page_ids),
                'locks' => $this->getLocks($page_ids, $cg, $lg),
                'textures' => $this->getTextures($detail_ids, $cg, $lg),
                'surfaces' => $this->getSurfaces($category, $page_ids, $detail_ids, $cg, $lg),
                'decors' => $this->getDecors($category, $page_ids, $detail_ids, $cg, $lg),
                'extra_features' => $this->getExtraFeatures($detail_ids, $cg, $lg),
                'bevels' => $this->getBevels($page_ids, $cg, $lg),
                'classes' => $this->getClasses($page_ids,$cg,$lg),
                'heights' => $this->getHeights($page_ids),
                'waters' => $this->getWaters($category, $detail_ids, $cg, $lg)
            ];
        });

    }

    private function getHeights($page_ids)
    {
        $height_data = [];
        $heights = \DB::table('page_extras')->where('key', 'height')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();

        foreach( $heights as $height ){
            $height_data[] = [
                'id' => $height,
                'name' => $height
            ];
        }
        return $height_data;
    }

    private function getClasses($page_ids, $cg, $lg)
    {
        $class_data = [];
        $classes = \DB::table('page_extras')->where('key', 'class')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();
        foreach( $classes as $class ){
            $checkifExists = \DB::table('pages')
                ->select(
                    'pages.id',
                    'pages.cvar_1',
                    'page_details.name'
                    )
                ->join('page_details', function($join)use($cg,$lg){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where('page_details.language_id', $lg->id)
                        ->where('page_details.country_group_id', $cg->id)
                        ->where('page_details.deleted_at', NULL);
                })
                ->where('pages.sitemap_id', PARKE_CLASSES_ST_ID)
                ->where('pages.status', 1)
                ->whereNull('pages.deleted_at')
                ->where('pages.cvar_1', $class)
                ->first();
            if( $checkifExists ){
                $class_data[] = [
                    'id' => $class,
                    'name' => $class
                ];
            }

        }
        $class_data = collect($class_data)->sortBy('name')->values();
        return $class_data;
    }

    private function getBevels($page_ids, $cg ,$lg)
    {
        $bevels_data = [];
        $bevel_ids = \DB::table('page_extras')->where('key', 'bevel')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();
        $bevels = \DB::table('pages')
            ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
            ->join('page_details', function($join)use($cg ,$lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('page_details.name', '!=', NULL)
                            ->where('page_details.name', '!=', '-');
                    })
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->where('pages.status', 1)
            ->whereIn('pages.id', $bevel_ids)
            ->whereNull('pages.deleted_at')
            ->orderBy('pages.order')
            ->get();

        foreach( $bevels as $bevel ){
            $name = strip_tags($bevel->name);
            $bevels_data[] = [
                'id' => $bevel->id,
                'name' => $name
            ];
        }
        $bevels_data = collect($bevels_data)->sortBy('name')->values();
        return $bevels_data;
    }

    private function getExtraFeatures($detail_ids, $cg, $lg)
    {
        $features_data = [];
        $feature_ids = \DB::table('page_detail_extras')->where('key', 'extra_feature')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
        $features = \DB::table('pages')
            ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
            ->join('page_details', function($join)use($cg,$lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('page_details.name', '!=', NULL)
                            ->where('page_details.name', '!=', '-');
                    })
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->where('pages.status', 1)
            ->whereIn('pages.id', $feature_ids)
            ->orderBy('pages.order')
            ->get();

        foreach( $features as $feature ){
            $name = strip_tags($feature->name);
            $features_data[] = [
                'id' => $feature->id,
                'name' => $name
            ];
        }
        $features_data = collect($features_data)->sortBy('name')->values();
        return $features_data;
    }

    private function getDecors($category, $page_ids, $detail_ids, $cg, $lg)
    {
        $decor_data = [];
        if( $category->category_id == 15 || $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64){
            $decor_ids = \DB::table('page_extras')->where('key', 'decor')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();
        }else{
            $decor_ids = \DB::table('page_detail_extras')->where('key', 'decor')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
        }
        $decors = \DB::table('pages')
            ->select('pages.id',
                'pages.cint_1',
                'page_details.name',
                'page_details.id as page_detail_id'
            )
            ->join('page_details', function($join)use($cg,$lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('page_details.name', '<>', "")->where('page_details.name', '!=', '-');
                    })
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->where('pages.status', 1)
            ->whereIn('pages.id', $decor_ids)
            ->orderBy('pages.order')
            ->get();

        foreach( $decors as $decor ){
            $name = strip_tags($decor->name);
            $decor_data[] = [
                'id' => $decor->id,
                'name' => $name
            ];
        }
        $decor_data = collect($decor_data)->sortBy('name')->values();
        return $decor_data;
    }

    private function getSurfaces($category, $page_ids, $detail_ids, $cg, $lg)
    {
        $surface_data = [];
        if( $category->category_id == 15 || $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64){
            $surface_ids = \DB::table('page_extras')->where('key', 'surface')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();
        }else{
            $surface_ids = \DB::table('page_detail_extras')->where('key', 'surface')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
        }
        $surfaces = \DB::table('pages')
            ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
            ->join('page_details', function($join) use($cg,$lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('page_details.name', '!=', NULL)
                            ->where('page_details.name', '!=', '-');
                    })
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->where('pages.status', 1)
            ->whereIn('pages.id', $surface_ids)
            ->orderBy('pages.order')
            ->get();

        foreach( $surfaces as $surface ){
            $name = strip_tags($surface->name);
            $surface_data[] = [
                'id' => $surface->id,
                'name' => $name
            ];
        }
        $surface_data = collect($surface_data)->sortBy('name')->values();
        return $surface_data;
    }

    private function getWaters($category,$detail_ids, $cg, $lg): \Illuminate\Support\Collection
    {
        $water_data = [];
        if( $category->category_id == 15 || $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64){
            $water_ids = \DB::table('page_detail_extras')->where('key', 'water')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
            $waters = \DB::table('pages')
                ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
                ->join('page_details', function($join) use($cg,$lg){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where(function($query){
                            return $query->where('page_details.name', '!=', NULL)
                                ->where('page_details.name', '!=', '-');
                        })
                        ->where('page_details.language_id', $lg->id)
                        ->where('page_details.country_group_id', $cg->id)
                        ->where('page_details.deleted_at', NULL);
                })
                ->where('pages.status', 1)
                ->whereIn('pages.id', $water_ids)
                ->orderBy('pages.order')
                ->get();

            foreach( $waters as $water ){
                $name = strip_tags($water->name);
                $water_data[] = [
                    'id' => $water->id,
                    'name' => $name
                ];
            }
        }

        return collect($water_data)->sortBy('name')->values();
    }

    private function getDimensions($detail_ids)
    {
        $dimension_data = [];
        $dimension_ids = \DB::table('page_detail_extras')->where('key', 'dimension')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
        $dimensions = \DB::table('pages')
            ->select('pages.id', 'pages.cvar_1')
            ->where('pages.status', 1)
            ->whereIn('pages.id', $dimension_ids)
            ->whereNull('pages.deleted_at')
            ->orderBy('pages.order')
            ->get();
        foreach( $dimensions as $dimension ){
            $dimension_data[] = [
                'id' => $dimension->id,
                'name' => $dimension->cvar_1
            ];
        }
        return $dimension_data;
    }

    private function getThickness($page_ids)
    {
        $data = [];

        $thickness_ids = \DB::table('page_extras')
            ->where('key', 'thickness')
            ->whereIn('page_id', $page_ids)
            ->get()
            ->pluck('value')
            ->unique()
            ->toArray();
        $thicknesses = \DB::table('pages')
            ->select('pages.id', 'pages.cvar_1')
            ->where('pages.status', 1)
            ->whereIn('pages.id', $thickness_ids)
            ->whereNull('pages.deleted_at')
            ->orderBy('pages.order')
            ->get();
        foreach( $thicknesses as $thickness ){
            $data[] = [
                'id' => $thickness->id,
                'name' => $thickness->cvar_1
            ];
        }
        return $data;
    }

    private function getTextures($detail_ids, $cg, $lg){
        $texture_data = [];
        $texture_ids = \DB::table('page_detail_extras')->where('key', 'texture')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
        $textures = \DB::table('pages')
            ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
            ->join('page_details', function($join)use($cg,$lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('page_details.name', '!=', NULL)
                            ->where('page_details.name', '!=', '-');
                    })
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->where('pages.status', 1)
            ->whereIn('pages.id', $texture_ids)
            ->orderBy('pages.order')
            ->get();

        foreach( $textures as $texture ){
            $name = strip_tags($texture->name);
            $texture_data[] = [
                'id' => $texture->id,
                'name' => $name
            ];
        }
        $texture_data = collect($texture_data)->sortBy('name')->values();
        return $texture_data;
    }

    private function getLocks($page_ids, $cg, $lg)
    {
        $locks_data = [];
        $lock_ids = \DB::table('page_extras')->where('key', 'lock')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();
        $locks = \DB::table('pages')
            ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
            ->join('page_details', function($join)use($cg,$lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('page_details.name', '!=', NULL)
                            ->where('page_details.name', '!=', '-');
                    })
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->where('pages.status', 1)
            ->whereIn('pages.id', $lock_ids)
            ->orderBy('pages.order')
            ->get();

        foreach( $locks as $lock ){
            $name = strip_tags($lock->name);
            $locks_data[] = [
                'id' => $lock->id,
                'name' => $name
            ];
        }
        $locks_data = collect($locks_data)->sortBy('name')->values();
        return $locks_data;
    }

    private function getCategory($category_id, $cg, $lg):array
    {
        $category = \DB::table('categories')
            ->select(
                'categories.id',
                'category_details.name'
            )
            ->join('category_details', function($join)use($cg,$lg){
                $join->on('category_details.category_id', '=', 'categories.id')
                    ->where('category_details.name', '!=', NULL)
                    ->where('category_details.language_id', $lg->id)
                    ->where('category_details.country_group_id', $cg->id)
                    ->where('category_details.deleted_at', NULL);
            })
            ->where('categories.id', $category_id)
            ->where('categories.status', 1)
            ->first();
        return [
            'id' => $category->id,
            'name' => $category->name
        ];
    }

    private function convertProduct($products, $cg, $lg):array
    {
        $products_data = [];
        $settings = Sitemap::find(1);
        foreach($products as $product){
            $image = 'assets/img/decors/'. str_replace(" ", "", $product->decor_code).'.jpg';
            if( $product->decor_image_id ){
                $image = get_image_path($product->decor_image_id);
                if( \File::exists(public_path($image)) ){
                    $image = asset($image);
                }
            }else if( \File::exists(public_path($image)) ){
                $image = asset($image);
            }else{
                $image = $settings->f_default_decor;
            }
            $category_page = \DB::table('category_page')->where('page_id', $product->id)->first();
            if($category_page){
                $category = \DB::table('categories')->where('id', $category_page->category_id)->first();
                if($category->id == 14){
                    $category_id = $category->id;
                }else{
                    $category_id = $category->category_id;
                }
                $products_data[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => asset(resizeImage($image, ['w'=>200,'h'=>200])->baseUrl),
                    'decor_code' => $product->decor_code,
                    'category_id' => $category_id
                ];
            }

        }
        return $products_data;
    }
    private function convertProducts($products, $category_id, $cg, $lg):array
    {
        $products_data = [];
        $settings = Sitemap::find(1);
        foreach($products as $product){
            $image = 'assets/img/decors/'. str_replace(" ", "", $product->decor_code).'.jpg';
            if( $product->decor_image_id ){
                $image = get_image_path($product->decor_image_id);
                if( \File::exists(public_path($image)) ){
                    $image = asset($image);
                }
            }else if( \File::exists(public_path($image)) ){
                $image = asset($image);
            }else{
                $image = $settings->f_default_decor;
            }
            $products_data[] = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => asset(resizeImage($image, ['w'=>200,'h'=>200])->baseUrl),
                'decor_code' => $product->decor_code,
                'three_d' => $product->three_d,
                'category_id' => $category_id,
                'is_new' => $product->cint_4 == 1,
                'is_recent' => $product->cvar_2 == 1
            ];
        }
        return $products_data;
    }

    public function getImageProduct($product, $settings)
    {
        $image = 'assets/img/decors/'. str_replace(" ", "", $product->decor_code).'.jpg';
        if( $product->decor_image_id ){
            $image = get_image_path($product->decor_image_id);
            if( \File::exists(public_path($image)) ){
                $image = asset($image);
            }
        }else if( \File::exists(public_path($image)) ){
            $image = asset($image);
        }else{
            $image = $settings->f_default_decor;
        }
        return $image;
    }

    private function getProductData($product, $category_id, $cg, $lg)
    {
        return Cache::remember('get_api_products_single_data'.$cg->code.'_'.$lg->code.'_'.$product->id, 7*24*60*60, function()use($product,$cg,$lg,$category_id){
            $product_data = [];
            $category_pages = \DB::table('category_page')->where('page_id', $product->id)->first();
            $category = get_category_of_page($category_pages->category_id,$cg,$lg);
            $current_category = get_category_of_page($category_id, $cg, $lg);
            $parke_categories = [15,16,41,60,64,72];
            $product_data['product_type'] = null;
            $product_data['name'] = $product->name;
            $product_data['decor_code'] = !empty($product->decor_code) ? $product->decor_code : null;
            $product_data['is_new'] = $product->cint_4 == 1;
            $product_data['is_recent'] = $product->cvar_2 == 1;
            $product_data['brand'] = null;
            $product_data['dimensions'] = [];
            $product_data['thicknesses'] = null;
            $product_data['decors'] = [];
            $product_data['surfaces'] = [];
            $product_data['textures'] = [];
            $product_data['extra_features'] = [];
            $product_data['locks'] = [];
            $product_data['bevels'] = [];
            $product_data['classes'] = [];
            $product_data['areas'] = [];
            $product_data['detail'] = null;
            $settings = \Mediapress\Modules\Content\Models\Sitemap::find(1);
            $product_image = $this->getImageProduct($product, $settings);
            $product_data['image'] = asset(resizeImage($product_image, ['w'=>412,'h'=>375])->baseUrl);
            $product_detail_extras = \DB::table('page_detail_extras')->where('page_detail_id', $product->page_detail_id)->get();
            if( $category_id != 5 ){
                $brand = get_brand_page_api($cg, $lg, $product->brand);
                if($brand){
                    $product_data['brand']['name'] = $brand->name;
                    $product_data['brand']['detail'] = strip_tags($brand->detail);
                    $product_data['brand']['usage_area'] = strip_tags($brand->usage_area);
                    $product_data['brand']['cint_2'] = $brand->cint_2;
                }
            }else{
                $brand_extra = $product_detail_extras->where('key', 'brand')->first();
                if($brand_extra){
                    $brand = get_brand_page_api($cg, $lg, $brand_extra->value);
                    if($brand){
                        $product_data['brand']['name'] = $brand->name;
                        $product_data['brand']['detail'] = strip_tags($brand->detail);
                        $product_data['brand']['usage_area'] = strip_tags($brand->usage_area);
                        $product_data['brand']['cint_2'] = $brand->cint_2;
                    }

                }
            }
            if(!in_array($category_id, $parke_categories)){
                $dimensions = $product_detail_extras->where('key', 'dimension')->pluck('value');
                $thicknesses = $product_detail_extras->where('key', 'thickness')->pluck('value');
                $decors = $product_detail_extras->where('key', 'decor')->pluck('value');
                $surfaces = $product_detail_extras->where('key', 'surface')->pluck('value');
                $textures = $product_detail_extras->where('key', 'texture')->pluck('value');
                $extra_features = $product_detail_extras->where('key', 'extra_feature')->pluck('value');
                $dimension_pages = get_pages_api_cint_one($cg, $lg, $dimensions);
                $thickness_pages = get_pages_api_cint_one($cg, $lg, $thicknesses);
                $decor_pages = get_pages_api($cg, $lg, $decors);
                $surface_pages = get_pages_api($cg, $lg, $surfaces);
                $texture_pages = get_pages_api($cg, $lg, $textures);
                $extra_features_pages = get_pages_api($cg, $lg, $extra_features);
                foreach($dimension_pages as $page){
                    $product_data['dimensions'][] = $page->name;
                }
                if($thickness_pages->count() > 0){
                    $thickness_text = count($thickness_pages) > 1 ? $thickness_pages[0]->name.' - '.$thickness_pages[$thickness_pages->count() - 1]->name : $thickness_pages[0]->name;
                    $product_data['thicknesses'] = $thickness_text;
                }
                foreach($decor_pages as $page){
                    $product_data['decors'][] = $page->name;
                }
                foreach($surface_pages as $page){
                    $product_data['surfaces'][] = $page->name;
                }
                foreach($texture_pages as $page){
                    $product_data['textures'][] = $page->name;
                }
                foreach($extra_features_pages as $page){
                    $product_data['extra_features'][] = $page->name;
                }
                if( $category_id == 2){
                    $product_data['product_type'] = $category->name;
                }
            }else{
                $product_data['product_type'] = $category->name;
                $product_extras = \DB::table('page_extras')->where('page_id', $product->id)->get();
                $dimensions = $product_detail_extras->where('key', 'dimension')->pluck('value');
                $areas = $product_detail_extras->where('key', 'area')->pluck('value');
                $thicknesses = $product_extras->where('key', 'thickness')->pluck('value');
                $decors = $product_extras->where('key', 'decor')->pluck('value');
                $surfaces = $product_extras->where('key', 'surface')->pluck('value');
                $locks = $product_extras->where('key', 'lock')->pluck('value');
                $bevels = $product_extras->where('key', 'bevel')->pluck('value');
                $classes = $product_extras->where('key', 'class')->pluck('value');
                $dimension_pages = get_pages_api_cint_one($cg, $lg, $dimensions);
                $area_pages = get_pages_api_cint_one($cg, $lg, $areas);
                $thickness_pages = get_pages_api_cint_one($cg, $lg, $thicknesses);
                $decor_pages = get_pages_api($cg, $lg, $decors);
                $surface_pages = get_pages_api($cg, $lg, $surfaces);
                $lock_pages = get_pages_api($cg, $lg, $locks);
                $bevel_pages = get_pages_api($cg, $lg, $bevels);
                foreach($dimension_pages as $page){
                    $product_data['dimensions'][] = $page->name;
                }
                $product_data['thicknesses'] =  count($thickness_pages) > 1 ? $thickness_pages[0]->name.' - '.$thickness_pages[$thickness_pages->count() - 1]->name : $thickness_pages[0]->name;
                foreach($decor_pages as $page){
                    $product_data['decors'][] = $page->name;
                }
                foreach($surface_pages as $page){
                    $product_data['surfaces'][] = $page->name;
                }
                foreach($lock_pages as $page){
                    $product_data['locks'][] = $page->name;
                }
                foreach($bevel_pages as $page){
                    $product_data['bevels'][] = $page->name;
                }
                if($classes){
                    $product_data['classes'] = $classes;
                }
                foreach($area_pages as $page){
                    $product_data['areas'][] = $page->name;
                }
            }
            if( ($category_id == 5 || $category_id == 14) && !is_null($product_data['brand'])){
                $product_data['detail']['title'] = $product_data['brand']['name'];
                if( !empty($product_data['brand']['detail']) ){
                    $product_data['detail']['detail'] = $product_data['brand']['detail'];
                }else{
                    $product_data['detail']['detail'] = strip_tags($product->detail);
                }
                if($product->usage_area != "" && !empty($product->usage_area)){
                    $product_data['usage_area'] = strip_tags($product->usage_area);
                }else{
                    $product_data['usage_area'] = strip_tags($product_data['brand']['usage_area']);
                }
            }else{
                if(in_array($category_id, $parke_categories)){
                    $product_data['detail']['title'] = $current_category->name;
                }else{
                    $product_data['detail']['title'] = 'about_product';
                }
                if(!empty($product->detail)){
                    $product_data['detail']['detail'] = strip_tags($product->detail);
                }else if(!empty($category->detail)){
                    $product_data['detail']['detail'] = strip_tags($category->detail);
                }else{
                    $parent_category = get_category_of_page($category->category_id,$cg,$lg);
                    $product_data['detail']['detail'] = strip_tags($parent_category->detail);
                }
                if($product->usage_area != "" && !empty($product->usage_area)){
                    $product_data['usage_area'] = strip_tags($product->usage_area);
                }else if(!empty($category->usage_area)){
                    $product_data['usage_area'] = strip_tags($category->usage_area);
                }else{
                    $parent_category = get_category_of_page($category->category_id,$cg,$lg);
                    $product_data['usage_area'] = strip_tags($parent_category->usage_area);
                }
            }
            $certificate_ids = $product_detail_extras->where('key', 'certificate')->pluck('value');
            $product_data['certificates'] = $this->getCertificateData($certificate_ids, $cg, $lg, $settings);

            $feature_ids = $product_detail_extras->where('key', 'feature')->pluck('value');
            $features_ids = $product_detail_extras->where('key', 'features')->pluck('value');
            $feature_page_ids = $feature_ids->merge($features_ids);
            $product_data['features'] = $this->getFeaturesData($feature_page_ids, $cg, $lg, $settings);
            $product_data['gallery_images'] = $this->getGalleries($product->id, $product->page_detail_id, $cg, $lg);
            if($product->active_online == 1){
                $product_data['three_d'] =  false;
                $product_data['virtual_room'] = false;
                $product_data['see_in_room'] =  false;
            }else if($category_id == 14 ){
                if(!empty($product->three_d)){
                    $three_d_field = $product->three_d;
                }else if( count($product_data['surfaces']) > 0 ){
                    $surfacePagesEn = get_pagesby_en($surfaces);
                    $surfaceText = $surfacePagesEn->toArray();
                    $three_d_field = $product_data['decor_code'].'_'.$surfaceText[0];
                }else{
                    $three_d_field = $product_data['decor_code'].'_'.setMatteGloss($product_data['brand']['cint_2']);
                }
                $three_d = !empty($current_category->three_d) ? $current_category->three_d : false;
                $product_data['three_d'] = $three_d ? $three_d.''.$three_d_field : false;
                $product_data['virtual_room'] = !empty($current_category->virtual_room) ? $current_category->virtual_room.''.$product->id.'&hideLinks=true' : false;
                $product_data['see_in_room'] = !empty($current_category->see_in_room) ? $current_category->see_in_room.''.$product->id.'&hideLinks=true' : false;
            }else if($category_id != 2 && $category_id != 72 ){
                $three_d_option = true;
                if(!empty($product->three_d)){
                    $three_d_field = $product->three_d;
                }else if( count($product_data['surfaces']) > 0 ){
                    $surfacePagesEn = get_pagesby_en($surfaces);
                    $surfaceText = $surfacePagesEn->toArray();
                    $three_d_field = $product_data['decor_code'].'_'.$surfaceText[0];
                }else if(!is_null($product_data['brand'])){
                    $three_d_field = $product_data['decor_code'].'_'.setMatteGloss($product_data['brand']['cint_2']);
                }else{
                    $three_d_option = false;
                }
                if($three_d_option){
                    $three_d = !empty($current_category->three_d) ? $current_category->three_d : false;
                    $product_data['three_d'] = $three_d ? $three_d.''.$three_d_field : false;
                }else{
                    $product_data['three_d'] =  false;
                }
                $product_data['virtual_room'] = !empty($current_category->virtual_room) ? $current_category->virtual_room.''.$product->id.'&hideLinks=true' : false;
                $product_data['see_in_room'] = !empty($current_category->see_in_room) ? $current_category->see_in_room.''.$product->id.'&hideLinks=true' : false;
            }else{
                $product_data['three_d'] =  false;
                $product_data['virtual_room'] = false;
                $product_data['see_in_room'] =  false;
            }
            $product_data['models'] = false;
            if($category_id == 2){
                $product_models = $this->getProductModels($product, $cg, $lg);
                if($product_models->isNotEmpty()){
                    $product_data['models'] = $product_models;
                }
            }
            return $product_data;
        });

    }

    private function getProductModels($product, $cg, $lg)
    {
        return \DB::table('pages')
            ->select(
                'page_details.name',
                'page_details.detail',
                'page_detail_extras.value as summary'
            )
            ->join('page_details', function($join)use($cg, $lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('page_details.name', '!=', NULL)
                            ->where('page_details.name', '!=', '-');
                    })
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->leftJoin('page_detail_extras', function($join){
                $join->on('page_detail_extras.page_detail_id', '=', 'page_details.id')->where('key', 'summary');
            })
            ->where('pages.status', 1)
            ->where('pages.page_id', $product->id)
            ->orderBy('pages.order')
            ->get();
    }

    private function getFeaturesData($features_ids, $cg, $lg, $settings):array
    {
        $feature_data = [];
        $feature_pages = $this->getFeatures($features_ids, $cg, $lg);
        foreach($feature_pages as $feature){
            if( !is_null($feature->cover_image_id) ){
                $feature_data[] = [
                    'name' => $feature->name,
                    'image' => get_image($feature->cover_image_id)
                ];
            }elseif(\File::exists(public_path('assets/img/features/'.\Str::slug($feature->english_name, '-').'.png')) ){
                $featureImage = asset('assets/img/features/'.\Str::slug($feature->english_name, '-').'.png');
                $feature_data[] = [
                    'name' => $feature->name,
                    'image' => $featureImage
                ];
            }else{
                $featureImage = image($settings->f_default_feature);
                $feature_data[] = [
                    'name' => $feature->name,
                    'image' => $featureImage
                ];
            }
        }
        return $feature_data;
    }

    private function getCertificateData($certificate_ids, $cg, $lg, $settings):array
    {
        $certificate_data = [];
        $certificate_pages = $this->getCertificates($certificate_ids, $cg, $lg);
        foreach($certificate_pages as $certificate){
            if(!is_null($certificate->native_cover_image_id)){
                $certificate_data[] = [
                    'name' => $certificate->name,
                    'image' => get_image($certificate->native_cover_image_id)
                ];
            }else if( !is_null($certificate->cover_image_id) ){
                $certificate_data[] = [
                    'name' => $certificate->name,
                    'image' => get_image($certificate->cover_image_id)
                ];
            }elseif( \File::exists(public_path('assets/img/certificates/'.$lg.'/'.\Str::slug($certificate->english_name, '-').'.png')) ){
                $certImage = asset('assets/img/certificates/'.$lg.'/'.\Str::slug($certificate->english_name, '-').'.png');
                $certificate_data[] = [
                    'name' => $certificate->name,
                    'image' => $certImage
                ];
            }else{
                $certImage = image($settings->f_default_certificate);
                $certificate_data[] = [
                    'name' => $certificate->name,
                    'image' => $certImage
                ];
            }
        }
        return $certificate_data;
    }

    private function getCertificates($certificateIds, $cg, $lg)
    {
        return \DB::table('pages')
            ->select('pages.id', 'native_language.name as name', 'english_name.name as english_name', 'cover_image.mfile_id as cover_image_id', 'native_cover_image.mfile_id as native_cover_image_id')
            ->join('page_details as native_language', function($join)use($cg, $lg){
                $join->on('native_language.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('native_language.name', '<>', "")
                            ->where('native_language.name', '!=', '-');
                    })
                    ->where('native_language.language_id', $lg->id)
                    ->where('native_language.country_group_id', $cg->id)
                    ->where('native_language.deleted_at', NULL);
            })
            ->join('page_details as english_name', function($join){
                $join->on('english_name.page_id', '=', 'pages.id')
                    ->where('english_name.language_id', 616)
                    ->where('english_name.country_group_id', 1)
                    ->where('english_name.deleted_at', NULL);
            })
            ->leftJoin('mfile_general as cover_image', function($join){
                $join->on('cover_image.model_id', '=', 'pages.id')->where('cover_image.file_key', 'cover')->where('cover_image.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->leftJoin('mfile_general as native_cover_image', function($join){
                $join->on('native_cover_image.model_id', '=', 'native_language.id')->where('native_cover_image.file_key', 'cover')->where('native_cover_image.model_type', 'Mediapress\Modules\Content\Models\PageDetail');
            })
            ->where('pages.status', 1)
            ->whereIn('pages.id', $certificateIds)
            ->get()
            ->toArray();
    }

    private function getFeatures($featureIds, $cg, $lg)
    {
        return \DB::table('pages')
            ->select('pages.id', 'native_language.name as name', 'english_name.name as english_name', 'cover_image.mfile_id as cover_image_id')
            ->join('page_details as native_language', function($join)use($cg, $lg){
                $join->on('native_language.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('native_language.name', '<>', "")
                            ->where('native_language.name', '!=', '-');
                    })
                    ->where('native_language.language_id', $lg->id)
                    ->where('native_language.country_group_id', $cg->id)
                    ->where('native_language.deleted_at', NULL);
            })
            ->join('page_details as english_name', function($join){
                $join->on('english_name.page_id', '=', 'pages.id')
                    ->where('english_name.language_id', 616)
                    ->where('english_name.country_group_id', 1)
                    ->where('english_name.deleted_at', NULL);
            })
            ->leftJoin('mfile_general as cover_image', function($join){
                $join->on('cover_image.model_id', '=', 'pages.id')->where('cover_image.file_key', 'cover')->where('cover_image.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->where('pages.status', 1)
            ->whereIn('pages.id', $featureIds)
            ->get()
            ->toArray();
    }

    private function getProductBrand($cg,$lg,$brand_ids)
    {
        $brand = \DB::table('pages')
            ->select(
                'pages.id',
                'pages.cint_1',
                'page_details.name'
            )
            ->join('page_details', function($join)use($cg,$lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '!=', NULL)
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->where('pages.sitemap_id', BRANDS_ST_ID)
            ->where('pages.status', 1)
            ->where('pages.cint_1', $brand_ids[0])
            ->first();
        return $brand;
    }

    private function getGalleries($product_id, $page_detail_id, $cg, $lg): array
    {
        $image_data = [];
        $product = Page::where('sitemap_id', PRODUCT_ST_ID)->where('id', $product_id)->first();
        $category = $product->categories[0];
        $page_detail = PageDetail::find($page_detail_id);
        if( isset($page_detail->f_gallery) ){
            if($page_detail->f_gallery[0]){
                foreach($page_detail->f_gallery as $imageItem){
                    $image = image($imageItem);
                    array_push($image_data, $image->originalUrl);
                }
            }else{
                $image = image($page_detail->f_gallery);
                array_push($image_data, $image->originalUrl);
            }
        }else{
            for( $i = 1; $i < 10; $i++ ){
                $image_url = 'assets/img/galeri/'.$product->cint_3.'-'.$i.'.jpg';
                if($category->category_id == 5){
                    $brand_value = \DB::table('page_detail_extras')->where('page_detail_id', $page_detail->id)->where('key', 'brand')->where('value', '<>', '')->first();
                    if($brand_value){
                        $brand = \DB::table('pages')->where('sitemap_id', BRANDS_ST_ID)->where('cint_1', $brand_value->value)->first();
                        $image_url = 'assets/img/galeri/'.$product->cint_3.'-'.$i.'-1-'.$brand->id.'.jpg';
                    }
                }
                if( $cg->code == 'ru'){
                    $image_url = 'assets/img/galeri/'.$product->cint_3.'-'.$i.'-5.jpg';
                }
                if( $cg->code == 'rg'){
                    $image_url = 'assets/img/galeri/'.$product->cint_3.'-'.$i.'-7.jpg';
                }
                $image = asset($image_url);
                if(\File::exists(public_path($image_url))){
                    array_push($image_data, $image);
                }
            }
        }

        return $image_data;
    }
}
