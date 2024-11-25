<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\PageDetail;
use Mediapress\Modules\Content\Models\Sitemap;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\Language;
use function GuzzleHttp\Psr7\str;

class ProductController extends BaseController
{

    private ?int $language_id = NULL;
    private ?int $country_group_id = NULL;

    public function __construct()
    {
        if( request()->input('lg') ){
            $this->language_id = intval(request()->input('lg'));
        }
        if( request()->input('lg') ){
            $this->country_group_id = intval(request()->input('cg'));
        }
    }

    public function SitemapDetail(Mediapress $mediapress) {
        return redirect(getUrlBySitemapId(1), 301);
	}

    public function PageDetail(Mediapress $mediapress) {
        $page = $mediapress->parent;
        if($page->detail->name == '-' || $page->detail->name == ''){
            return redirect($mediapress->homePageUrl);
        }
        $category = $page->categories[0];
        $documents = [];
        $mediapress->data['sitemap'] = $mediapress->sitemap;
        $mediapress->data['page'] = $page;
        $mediapress->data['breadcrumbs'] = self::setCategoryBreadCrumbs($category, $mediapress);
        $mediapress->data['category'] = $page->categories[0];
        $mediapress->data['data'] = self::setProductData($page, $mediapress);

        $mediapress->data['galleries'] = self::getGalleries($page, $mediapress);
        $mediapress->data['mdf_pages'] = false;

        if( $category->id == 2 || $category->category_id == 2 ){
            $mediapress->data['mdf_pages'] = self::getMdfSubPages($page, $mediapress);
        }

        if( $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64 || $category->category_id == 2 ){
            $documents = self::getDocuments($page);
        }else{
            $brand_id = $mediapress->data['data']['brand_id'] ?? false;
            if($brand_id){
                $documentPages = Page::where('sitemap_id', BRAND_DOCUMENT_ST_ID)->where('status', 1)->where('page_id', $brand_id)->get();
                $documents = self::getBrandDocuments($documentPages);
            }

        }

        $mediapress->data['documents'] = $documents;

		return view('web.pages.product.page');
	}

    public function CategoryDetail(Mediapress $mediapress) {
        $category = $mediapress->parent;
        if($category->detail->name == '-'){
            return redirect($mediapress->homePageUrl);
        }
        $sitemap = $mediapress->sitemap;
        $mediapress->data['category'] = $category;
        $mediapress->data['sitemap'] = $sitemap;

        if( $category->category_id == 0 ){
            return view('web.pages.product.category_children', compact('mediapress', 'category'));
        }else{
            $view_data = [
                'product_list' => 'decor_list_four',
                'col_list' => 'col-lg-4 col-xl-3 col-md-4 col-sm-6 col-6',
                'decor_view_button' => true
            ];
            if( $category->id == 2 || $category->id == 3 || $category->id == 4 ){
                $view_data = [
                    'product_list' => 'mdf_list',
                    'col_list' => 'col-lg-4 col-xl-3 col-md-4 col-sm-6 col-6',
                    'decor_view_button' => false
                ];
            }

            if( $category->id == 11 || $category->id == 12 || $category->id == 13 ){
                $view_data = [
                    'product_list' => 'door_list',
                    'col_list' => 'col-xl-3 col-md-4 col-sm-6 col-6',
                    'decor_view_button' => false
                ];
            }

            if( $category->id == 72 || $category->id == 73 || $category->id == 74 ){
                $view_data = [
                    'product_list' => 'decor_appearance',
                    'col_list' => 'col-lg-4 col-xl-3 col-md-4 col-sm-6 col-6',
                    'decor_view_button' => false
                ];
            }
            $mediapress->data['view_data'] = $view_data;
            $mediapress->data['extras'] = self::getCategoryTabs($category, $mediapress);
            $mediapress->data['documents'] = self::getCategoryDocuments($category);
            $mediapress->data['breadcrumbs'] = self::setCategoryBreadCrumbs($category, $mediapress);
            return view('web.pages.product.category', compact('mediapress'));
        }

	}

    private function setProductData($product, $mediapress)
    {
        return Cache::remember('product_data_'.$mediapress->activeCountryGroup->code.'_'.$mediapress->activeLanguage->code.'_'.$product->id, 7*24*60*60, function()use($mediapress, $product){
            $product_data['decor_code'] = $product->cint_3;
            $product_data['id'] = $product->id;

            $product_extras = \DB::table('page_extras')->where('page_id', $product->id)->get()->groupBy('key');
            $category = $product->categories[0];
            $parent_category = $category->parent;
            $product_data['category_title'] = false;
            if($category->id == 2 || $category->category_id == 2){
                $product_data['title'] = $product->detail->summary;
                $product_data['summary'] = $product->detail->name;
                $product_data['category_title'] = true;
                $product_data['category_title_text'] = $category->detail->name;
            }else{
                $product_data['title'] = $product->detail->name;
            }
            if( $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64 || $category->category_id == 72 ){
                $product_data['category_title'] = true;
                $product_data['category_title_text'] = $category->detail->name;
            }
            $product_detail_extras = \DB::table('page_detail_extras')->where('page_detail_id', $product->detail->id)->get()->groupBy('key');
            $product->page_detail_id = $product->detail->id;
            $product_data['bg'] = image($category->f_background);
            if( $category->id != 5 && $category->category_id != 5 ){
                $brandPages = get_brand_pages($mediapress, $product->cint_1);
                if($brandPages->isNotEmpty()){
                    $product_data['brand'] = $brandPages[0];
                    $product_data['brand_id'] = $brandPages[0]->id;
                }

            }


            foreach( $product_extras as $key => $extra ){
                if( $key == 'thickness' ){
                    $thickness_data = [];
                    $thicknesses_ids = $extra->pluck('value')->unique()->toArray();
                    $thicknesses = \DB::table('pages')->where('sitemap_id', 25)->whereIn('id', $thicknesses_ids)->orderBy('order')->get();

                    foreach($thicknesses as $thickness){
                        array_push($thickness_data, $thickness->cvar_1);
                    }

                    if( count($thickness_data) > 1 ){
                        $product_data['thicknesses'] = $thickness_data[0] .'-'. $thickness_data[count( $thickness_data)-1];
                    }else{
                        $product_data['thicknesses'] = $thickness_data[0];
                    }
                }
                if( $key == 'lock' ){
                    $lockIds = self::getLockIds($product);
                    $lockPages = get_pages($mediapress, $lockIds);
                    $product_data['locks'] = implode(',', $lockPages->pluck('name')->toArray());
                }
                if( $key == 'bevel' ){
                    $bevelIds = self::getBevelIds($product);
                    $bevelPages = get_pages($mediapress, $bevelIds);
                    $product_data['bevels'] = implode(',', $bevelPages->pluck('name')->toArray());
                }
                if( $key == 'decor' ){
                    $decorIds = self::getDecorIds($product, $category->category_id);
                    $decorPages = get_pages($mediapress, $decorIds);
                    $product_data['decors'] = implode(',', $decorPages->pluck('name')->toArray());
                }
                if( $key == 'surface' ){
                    $surfaceIds = self::getSurfaceIds($product, $category->category_id);
                    $surfacePages = get_pages($mediapress, $surfaceIds);
                    $product_data['surfaces'] = implode(',', $surfacePages->pluck('name')->toArray());
                }
                if( $key == 'class' ){
                    $classes = implode(', ', $extra->sortBy('value')->pluck('value')->unique()->toArray());
                    if( $classes != ""){
                        $product_data['class'] = $classes;
                    }
                }
            }

            foreach( $product_detail_extras as $key => $extra ){
                if( $key == 'dimension' ){
                    $dimensions_ids = $extra->pluck('value')->unique()->values();
                    $dimensions = \DB::table('pages')->where('sitemap_id', 24)->whereIn('id', $dimensions_ids)->whereNull('deleted_at')->orderBy('order')->get();
                    if($dimensions->isNotEmpty()){
                        foreach( $dimensions as $dimension ){
                            $product_data['dimensions'][] = $dimension->cvar_1;
                        }
                    }
                }
                if( $key == 'thickness' ){
                    $thickness_data = [];
                    $thicknesses_ids = $extra->pluck('value')->unique()->toArray();
                    $thicknesses = \DB::table('pages')->where('sitemap_id', 25)->whereIn('id', $thicknesses_ids)->orderBy('order')->get();

                    foreach($thicknesses as $thickness){
                        array_push($thickness_data, $thickness->cvar_1);
                    }
                    if( count($thickness_data) > 1 ){
                        $product_data['thicknesses'] = $thickness_data[0] .'-'. $thickness_data[count($thickness_data)-1];
                    }else{
                        $product_data['thicknesses'] = $thickness_data[0];
                    }


                }

                if( $key == 'area' ){
                    $area_ids = $extra->pluck('value')->unique()->toArray();
                    $areas = \DB::table('pages')->where('sitemap_id', 34)->whereIn('id', $area_ids)->orderBy('order')->get();
                    $area_data = [];
                    if( $areas->isNotEmpty() ){
                        foreach($areas as $area){
                            array_push($area_data, $area->cvar_1);
                        }
                        $product_data['areas'] = implode(',', $area_data);
                    }
                }

                if( $key == 'extra_feature' ){
                    $extraFeaturesIds = self::getExtraFeaturesIds($product);
                    $extraFeaturePages = get_pages($mediapress, $extraFeaturesIds);
                    $product_data['extra_features'] = implode(',', $extraFeaturePages->pluck('name')->toArray());
                }

                if( $key == 'surface' ){
                    $surfaceIds = self::getSurfaceIds($product, $category->category_id);
                    $surfacePages = get_pages($mediapress, $surfaceIds);
                    $product_data['surfaces'] = implode(',', $surfacePages->pluck('name')->toArray());
                }

                if( $key == 'decor' ){
                    $decorIds = self::getDecorIds($product, $category->category_id);
                    $decorPages = get_pages($mediapress, $decorIds);
                    $product_data['decors'] = implode(',', $decorPages->pluck('name')->toArray());
                }

                if( $key == 'feature' ){
                    $featureIds = self::getFeatureIds($product);

                    $featurePages = \DB::table('pages')
                        ->select('pages.id', 'native_language.name as name', 'english_name.name as english_name', 'cover_image.mfile_id as cover_image_id')
                        ->join('page_details as native_language', function($join)use($mediapress){
                            $join->on('native_language.page_id', '=', 'pages.id')
                                ->where(function($query){
                                    return $query->where('native_language.name', '!=', NULL)
                                        ->where('native_language.name', '!=', '-');
                                })
                                ->where('native_language.language_id', $mediapress->activeLanguage->id)
                                ->where('native_language.country_group_id', $mediapress->activeCountryGroup->id)
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

                    $product_data['feature'] = $featurePages;
                }

                if( $key == 'features' ){

                    $featureIds = self::getFeaturesIds($product);
                    $featurePages = \DB::table('pages')
                        ->select('pages.id', 'native_language.name as name', 'english_name.name as english_name', 'cover_image.mfile_id as cover_image_id')
                        ->join('page_details as native_language', function($join)use($mediapress){
                            $join->on('native_language.page_id', '=', 'pages.id')
                                ->where(function($query){
                                    return $query->where('native_language.name', '!=', NULL)
                                        ->where('native_language.name', '!=', '-');
                                })
                                ->where('native_language.language_id', $mediapress->activeLanguage->id)
                                ->where('native_language.country_group_id', $mediapress->activeCountryGroup->id)
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
                    $product_data['feature'] = $featurePages;
                }


                if( $key == 'certificate' ){
                    $certificateIds = self::getCertificateIds($product);
                    $certPages = \DB::table('pages')
                        ->select('pages.id', 'native_language.name as name', 'english_name.name as english_name', 'cover_image.mfile_id as cover_image_id', 'native_cover_image.mfile_id as native_cover_image_id')
                        ->join('page_details as native_language', function($join)use($mediapress){
                            $join->on('native_language.page_id', '=', 'pages.id')
                                ->where(function($query){
                                    return $query->where('native_language.name', '!=', NULL)
                                        ->where('native_language.name', '!=', '-');
                                })
                                ->where('native_language.language_id', $mediapress->activeLanguage->id)
                                ->where('native_language.country_group_id', $mediapress->activeCountryGroup->id)
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

                    $product_data['certificates'] = $certPages;
                }

                if( $key == 'brand' && $category->id != 14 ){
                    $brandIds = self::getBrandIds($product);
                    $brandPages = get_brand_pages($mediapress, $brandIds);
                    if($brandPages->isNotEmpty()){
                        $product_data['brand'] = $brandPages[0];
                        $product_data['brand_id'] = $brandPages[0]->id;
                    }
                }


            }
            $product_data['detail_if_brand'] = false;
            if($product->detail->length){
                $product_data['length'] = strip_tags($product->detail->length);
            }
            if($product->detail->material){
                $product_data['material'] = strip_tags($product->detail->material);
            }

            if($product->detail->edge_band){
                $product_data['edge_band'] = strip_tags($product->detail->edge_band);
                $product_data['edge_band_url'] = strip_tags($product->detail->edge_band_url);
            }
            if($product->detail->compatible_panel){
                $product_data['compatible_panel'] = strip_tags($product->detail->compatible_panel);
                $product_data['compatible_panel_url'] = strip_tags($product->detail->compatible_panel_url);
            }
            if( ($category->category_id == 5 || $category->id == 14) && isset($product_data['brand_id']) && $product_data['brand_id'] != "" ){
                if( strip_tags($product->detail->detail) == "" ){
                    $brand = Page::find($product_data['brand_id']);
                    $product_data['detail_if_brand'] = true;
                    $product_data['detail'] = $brand->detail->detail;
                    $product_data['detail_title'] = $brand->detail->name;
                }else{
                    $product_data['detail'] = $product->detail->detail;
                }
                if( strip_tags($product->detail->usage_area) == "" ){
                    $product_data['usages'] = $brand->detail->usages;
                }else{
                    $product_data['usages'] = $product->detail->usage_area;
                }

                if( $brand->detail->f_layer_image ){
                    $product_data['layer_image'] = image($brand->detail->f_layer_image)->originalUrl;
                }elseif($category->detail->f_layer_image_zone){
                    $product_data['layer_image'] = image($category->detail->f_layer_image_zone)->originalUrl;
                }elseif( $category->f_layer_image ){
                    $product_data['layer_image'] = image($category->f_layer_image)->originalUrl;
                }elseif( $category->parent->detail->f_layer_image_zone ){
                    $product_data['layer_image'] = image($category->parent->detail->f_layer_image_zone)->originalUrl;
                }elseif( $category->parent->f_layer_image ){
                    $product_data['layer_image'] = image($category->parent->f_layer_image)->originalUrl;
                }else{
                    $product_data['layer_image'] = false;
                }
            }else{
                if( $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64 || $category->category_id == 72 ){
                    $product_data['detail_title'] = $category->parent->detail->name;
                }
                if($product->detail->detail && !empty(strip_tags($product->detail->detail))){
                    $product_data['detail'] = $product->detail->detail;
                }else{
                    $product_data['detail'] = !empty(strip_tags($category->detail->detail)) ? $category->detail->detail : $category->parent->detail->detail;
                }

                if($product->detail->usage_area && !empty(strip_tags($product->detail->usage_area))){
                    $product_data['usages'] = $product->detail->usage_area;
                }else{
                    $product_data['usages'] = !empty(strip_tags($category->detail->usages)) ? $category->detail->usages : $category->parent->detail->usages;
                }
                if($category->detail->f_layer_image_zone){
                    $product_data['layer_image'] = image($category->detail->f_layer_image_zone)->originalUrl;
                }elseif( $category->f_layer_image ){
                    $product_data['layer_image'] = image($category->f_layer_image)->originalUrl;
                }elseif( $category->parent->detail->f_layer_image_zone ){
                    $product_data['layer_image'] = image($category->parent->detail->f_layer_image_zone)->originalUrl;
                }elseif( $category->parent->f_layer_image ){
                    $product_data['layer_image'] = image($category->parent->f_layer_image)->originalUrl;
                }else{
                    $product_data['layer_image'] = false;
                }
            }

            if( $product->f_cover ){
                $product_data['image'] = image($product->f_cover)->originalUrl;
            }else{
                if( \File::exists(public_path('assets/img/decors/'.$product->cint_3.'.jpg')) ){
                    $product_data['image'] = asset('assets/img/decors/'.$product->cint_3.'.jpg');
                }else{
                    $settings = Sitemap::find(1);
                    $product_data['image'] = image($settings->f_default_decor)->originalUrl;
                }

            }

            if( $product->cint_5 == 1 ){
                $product_data['threed'] =  false;
                $product_data['virtual_room'] = false;
                $product_data['see_in_room'] =  false;
            }else{
                if( $category->id == 14 ){
                    if($product->detail->threedparams && !empty(strip_tags($product->detail->threedparams))){
                        $extraThreeDField = strip_tags($product->detail->threedparams);
                    }elseif( isset($product_data['surfaces']) ){
                        $surfacePagesEn = get_pagesby_en($surfaceIds);
                        $surfaceText = $surfacePagesEn->toArray();
                        $extraThreeDField = $product_data['decor_code'].'_'.$surfaceText[0];
                    }else{
                        $extraThreeDField = $product_data['decor_code'].'_'.setMatteGloss($product_data['brand']->cint_2);
                    }
                    $threeD = !empty(strip_tags( $category->detail->threed)) ? strip_tags( $category->detail->threed) : false;
                    $product_data['threed'] = $threeD ? $threeD.$extraThreeDField : false;
                    $product_data['virtual_room'] = !empty(strip_tags($category->detail->virtual_room)) ? strip_tags($category->detail->virtual_room) : false;
                    $product_data['see_in_room'] = !empty(strip_tags($category->detail->see_in_room)) ? strip_tags($category->detail->see_in_room) : false;
                    /*}elseif( $parent_category->parent && $parent_category->parent->id == 15  ){
                        if($product->detail->threedparams && !empty(strip_tags($product->detail->threedparams))){
                            $extraThreeDField = strip_tags($product->detail->threedparams);
                        }elseif( isset($product_data['surfaces']) ){
                            $surfacePagesEn = get_pagesby_en($surfaceIds);
                            $surfaceText = $surfacePagesEn->toArray();
                            $extraThreeDField = $product_data['decor_code'].'_'.$surfaceText[0];
                        }else{
                            $extraThreeDField = $product_data['decor_code'].'_'.setMatteGloss($product_data['brand']->cint_2);
                        }
                        $parent_parent_detail = $parent_category->parent->detail;
                        $threeD = !empty(strip_tags($parent_parent_detail->threed)) ? strip_tags($parent_parent_detail->threed) : false;
                        $product_data['threed'] = $threeD ? $threeD.$extraThreeDField : false;
                        $product_data['virtual_room'] = !empty(strip_tags($parent_parent_detail->virtual_room)) ? strip_tags($parent_parent_detail->virtual_room) : false;
                        $product_data['see_in_room'] = !empty(strip_tags($parent_parent_detail->see_in_room)) ? strip_tags($parent_parent_detail->see_in_room) : false;*/
                }else{
                    $threeDCheck = true;
                    $parent_detail = $parent_category->detail;
                    $surfacePagesEn = get_pagesby_en($surfaceIds ?? []);
                    if($parent_category->id != 2 && $parent_category->id != 72 ){
                        if($product->detail->threedparams && !empty(strip_tags($product->detail->threedparams))){
                            $extraThreeDField = strip_tags($product->detail->threedparams);
                        }elseif( isset($product_data['surfaces']) && count($surfacePagesEn) > 0){
                            $surfaceText = $surfacePagesEn->toArray();
                            $extraThreeDField = $product_data['decor_code'].'_'.$surfaceText[0];
                        }else{
                            if(isset($product_data['brand'])){
                                $extraThreeDField = $product_data['decor_code'].'_'.setMatteGloss($product_data['brand']->cint_2);
                            }else{
                                $threeDCheck = false;
                            }
                        }

                        $threeD = !empty(strip_tags($parent_detail->threed)) ? strip_tags($parent_detail->threed) : false;
                        if($threeDCheck){
                            $product_data['threed'] = $threeD ? $threeD.$extraThreeDField : false;
                        }else{
                            $product_data['threed'] = false;
                        }

                    }else{
                        $product_data['threed'] = false;
                    }
                    $product_data['virtual_room'] = !empty(strip_tags($parent_detail->virtual_room)) ? strip_tags($parent_detail->virtual_room) : false;
                    $product_data['see_in_room'] = !empty(strip_tags($parent_detail->see_in_room)) ? strip_tags($parent_detail->see_in_room) : false;
                }
            }


            return $product_data;
        });

    }

    private function getGalleries($product, $mediapress): array
    {
        $image_data = [];
        $category = $product->categories[0];
        if( $product->detail->f_gallery ){
            if($product->detail->f_gallery[0]){
                foreach($product->detail->f_gallery as $imageItem){
                    $image = image($imageItem);
                    array_push($image_data, $image->originalUrl);
                }
            }else{
                $image = image($product->detail->f_gallery);
                array_push($image_data, $image->originalUrl);
            }
        }else{
            for( $i = 1; $i < 10; $i++ ){
                $image_url = 'assets/img/galeri/'.$product->cint_3.'-'.$i.'.jpg';
                if($category->category_id == 5){
                    $brand_value = \DB::table('page_detail_extras')->where('page_detail_id', $product->detail->id)->where('key', 'brand')->where('value', '<>', '')->first();
                    if($brand_value){
                        $brand = \DB::table('pages')->where('sitemap_id', BRANDS_ST_ID)->where('cint_1', $brand_value->value)->first();
                        $image_url = 'assets/img/galeri/'.$product->cint_3.'-'.$i.'-1-'.$brand->id.'.jpg';
                    }
                }
                if( $mediapress->activeCountryGroup->code == 'ru'){
                    $image_url = 'assets/img/galeri/'.$product->cint_3.'-'.$i.'-5.jpg';
                }
                if( $mediapress->activeCountryGroup->code == 'rg'){
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

    private function getDocuments($product): array
    {
        $document_data = [];

        $category = $product->categories[0];
        $documentIds = \DB::table('page_extras')
            ->where('key', 'category_document_list')
            ->where(function($query)use($category){
                return $query->where('value', $category->category_id)
                    ->orWhere('value', $category->id);
            })
            ->get()
            ->pluck('page_id');

        $documentPages = Page::where('sitemap_id', DOCUMENT_ST_ID)->whereIn('id', $documentIds)->where('status', 1)->orderBy('order')->get();
        if($documentPages->isNotEmpty()){
            foreach( $documentPages as $key => $page ){
                if($page->detail && isset($page->detail->f_document)){
                    $document_data[] = [
                        'name' => strip_tags($page->detail->name),
                        'file' => strip_tags(image($page->detail->f_document)),
                        'size' => filesize_text($page->detail->f_document->size)
                    ];
                }


            }

        }
        return $document_data;
    }

    private function getBrandDocuments($documents): array
    {
        $document_data = [];
        if($documents->isNotEmpty()){
            foreach( $documents as  $page ){
                if( $page->detail->f_document ){
                    $document_data[] = [
                        'name' => strip_tags($page->detail->name),
                        'file' => strip_tags(image($page->detail->f_document)),
                        'size' => filesize_text($page->detail->f_document->size)
                    ];
                }

            }

        }
        return $document_data;
    }

    private function getMdfSubPages($product, $mediapress)
    {
        return \DB::table('pages')
            ->select('pages.id', 'page_details.name as name', 'page_details.detail as detail', 'summary.value as summary_value')
            ->join('page_details', function($join)use($mediapress){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where(function($query){
                        return $query->where('page_details.name', '!=', NULL)
                            ->where('page_details.name', '!=', '-')
                            ->where('page_details.name', '<>', '');
                    })
                    ->where('page_details.language_id', $mediapress->activeLanguage->id)
                    ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->join('page_detail_extras as summary',function($join){
                $join->on('summary.page_detail_id', '=', 'page_details.id')->where('key', 'summary');

            })
            ->where('pages.status', 1)
            ->where('pages.page_id', $product->id)
            ->where('sitemap_id', MDF_SUB_PAGES_ST_ID)
            ->get();
    }

    private function getCategoryDocuments($category): array
    {
        $document_data = [];
        $documentIds = \DB::table('page_extras')->where('key', 'category_document_list')->where('value', $category->id)->get()->pluck('page_id');
        $documentPages = Page::where('sitemap_id', DOCUMENT_ST_ID)->whereIn('id', $documentIds)->where('status', 1)->orderBy('order')->get();
        if($documentPages->isNotEmpty()){
            foreach( $documentPages as $key => $page ){
                if( $page->detail->f_document && !is_null($page->detail->f_document) ){
                    $document_data[] = [
                        'name' => strip_tags($page->detail->name),
                        'file' => strip_tags(image($page->detail->f_document)),
                        'size' => isset($page->detail->f_document->size ) ? filesize_text($page->detail->f_document->size) : ""
                    ];
                }

            }

        }
        return $document_data;
    }

    private function getCategoryTabs($category, $mediapress): array
    {
        $extra_data = [];
        if( $category->id == 2  ){
            $classifications = self::getClassifications($mediapress);
            foreach( $category->children as $key => $children ){
                $extra_data[$children->id]['title'] = strip_tags($children->detail->name);
                $extras = \DB::table('category_detail_extras')
                    ->select('category_detail_extras.value', 'category_detail_extras.key', 'category_details.id as category_detail_id', 'categories.id')
                    ->join('category_details', function($join)use($mediapress){
                        $join->on('category_details.id', '=', 'category_detail_extras.category_detail_id')
                            ->where('language_id', $mediapress->activeLanguage->id)
                            ->where('country_group_id', $mediapress->activeCountryGroup->id);
                    })
                    ->join('categories', function($join){
                        $join->on('category_details.category_id', '=', 'categories.id');
                    })
                    ->where('categories.id', $children->id)
                    ->get();
                foreach($extras as $extra){
                    $extra_data[$children->id][$extra->key] = $extra->value;
                }
                if(isset($classifications[$children->id])){
                    $extra_data[$children->id]['classifications'] = collect($classifications[$children->id])->sortBy('list')->groupBy('list')->all();
                }
            }
        }elseif($category->id == 11 || $category->category_id == 11){
            $brands = Page::whereIn('id', [13,14])->where('status', 1)->get();
            foreach( $brands as $key => $brand ){
                if($brand->detail){
                    $extra_data[$key] = [
                        'general_info' => strip_tags($brand->detail->general_info) ? $brand->detail->general_info : NULL,
                        'usages' => strip_tags($brand->detail->usages) ? $brand->detail->usages : NULL,
                        'technical' => strip_tags($brand->detail->technical) ? $brand->detail->technical : NULL,
                        'title' => strip_tags(LangPart('category_brand_title'.\Str::slug($brand->detail->name), ':brand Door Panel', ['brand'=>$brand->detail->name]))
                    ];
                }

            }
        }elseif($category->id == 14){
            $brands = Page::whereIn('id', [11,12])->where('status', 1)->get();
            foreach( $brands as $key => $brand ){
                $extra_data[$key] = [
                    'general_info' => strip_tags($brand->detail->general_info) ? $brand->detail->general_info : NULL,
                    'usages' => strip_tags($brand->detail->usages) ? $brand->detail->usages : NULL,
                    'advantages' => strip_tags($brand->detail->advantages) ? $brand->detail->advantages : NULL,
                    'title' => strip_tags($brand->detail->name)
                ];
            }
        }else{
            $extras = \DB::table('category_detail_extras')
                ->select('category_detail_extras.value', 'category_detail_extras.key', 'category_details.id as category_detail_id', 'categories.id')
                ->join('category_details', function($join)use($mediapress){
                    $join->on('category_details.id', '=', 'category_detail_extras.category_detail_id')
                        ->where('language_id', $mediapress->activeLanguage->id)
                        ->where('country_group_id', $mediapress->activeCountryGroup->id);
                })
                ->join('categories', function($join){
                    $join->on('category_details.category_id', '=', 'categories.id');
                })
                ->where('categories.id', $category->id)
                ->get();
            foreach($extras as $extra){
                $extra_data[0][$extra->key] = $extra->value;
                $extra_data[0]['title'] = strip_tags($category->detail->name);
            }
            if( $category->id == 5 || $category->category_id == 5 || $category->category_id == 15 || $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 72 ){
                $ids = \DB::table('page_extras')->where('key', 'category_list')->where('value', $category->id)->get()->pluck('page_id');
                $featurePages = Page::where('sitemap_id', CATEGORY_FEATURES_ST_ID)->whereIn('id', $ids)->where('status', 1)->orderBy('order')->get();
                $certPages = Page::where('sitemap_id', CATEGORY_CERTIFICATE_ST_ID)->whereIn('id', $ids)->where('status', 1)->orderBy('order')->get();
                foreach( $featurePages as $key => $page ){
                    if($page){
                        if($page->detail){
                            $extra_data[0]['features'][] = [
                                'name' => strip_tags($page->detail->name),
                                'image' => strip_tags(image($page->f_))
                            ];
                        }

                    }
                }
                foreach( $certPages as $key => $page ){
                    if($page){
                        if($page->detail){
                            $extra_data[0]['certificates'][] = [
                                'name' => strip_tags($page->detail->name),
                                'image' => $page->detail->f_ ? strip_tags(image($page->detail->f_)) :  strip_tags(image($page->f_))
                            ];
                        }

                    }
                }
            }

        }
        if($category->category_id == 1 || $category->category_id == 15 || $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64 ){
            $surfaces = self::getSurfacesArray($category,$mediapress);
           if(count($surfaces) > 0){
               $extra_data[0]['surfaces'] = $surfaces;
           }

        }

        return $extra_data;
    }

    private function setCategoryBreadCrumbs($category, $mediapress): array
    {
        $bread_data = [];
        if( $category->parent()->count() > 0 ){
            $parent = $category->parent;
            if( $parent->parent()->count() > 0 ){
                $up_parent = $parent->parent;
                $bread_data[] = [
                    'url' => '#',
                    'name' => strip_tags($up_parent->detail->name)
                ];
                if($parent->detail){
                    $bread_data[] = [
                        'url' => $parent->detail->url,
                        'name' => strip_tags($parent->detail->name)
                    ];
                }
            }else{
                $bread_data[] = [
                    'url' => '#',
                    'name' => strip_tags($parent->detail->name)
                ];
            }
        }
        $bread_data[] = [
            'url' => strip_tags($category->detail->url),
            'name' => strip_tags($category->detail->name)
        ];
        return $bread_data;

    }

    public function getCategories(Request $request, Mediapress $mediapress)
    {

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $category = $request->input('category_id');
        $parent_category = $request->input('parent_category_id');
        $category_data = [];
        $categories = Category::where('sitemap_id', PRODUCT_ST_ID)
            ->where('status', 1)
            ->when($parent_category == 2 || $parent_category == 5 || $parent_category == 11 || $parent_category == 16 || $parent_category == 41 || $parent_category == 60 || $parent_category == 64 || $parent_category == 72, function($query)use($parent_category){
                return $query->where('category_id', $parent_category);
            })
            ->when($parent_category != 2 && $parent_category != 5 && $parent_category != 11 && $parent_category != 16 && $parent_category != 41 && $parent_category != 60 && $parent_category != 64 && $parent_category != 72, function($query)use($category){
                return $query->where('category_id', $category);
            })
            ->whereHas('detail', function($query){
                return $query->where('name', '!=', '-')
                    ->where('name', '<>', '')
                    ->whereNull('deleted_at');
            })
            ->get();
        foreach( $categories as $categoryItem ){

            $category_data[] = [
                'id' => $categoryItem->id,
                'name' => strip_tags($categoryItem->detail->name),
                'url' => strip_tags(url($categoryItem->detail->url)),
                'active' => $categoryItem->id == $category,
                'is_new' => $categoryItem->cint_2 == 1
            ];
        }
        $category_data = collect($category_data)->sortBy('name')->values();
        return response()->json($category_data);
    }

    public function getBrands(Request $request, Mediapress $mediapress): JsonResponse
    {
        $brand_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        $category = Category::find($current_category);
        if($category){
            if($category->id == 5 || $category->category_id == 5 ){
                $detail_ids = self::getPagesDetailsIds($current_category);
                $brand_ids = \DB::table('page_detail_extras')->where('key', 'brand')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
                $brands = Page::where('sitemap_id', BRANDS_ST_ID)->where('status', 1)->whereIn('cint_1', $brand_ids)->orderBy('order')->get();
            }else{
                $brand_ids = self::getCategoryPagesByCintOne($category);
                $brands = Page::where('sitemap_id', BRANDS_ST_ID)->where('status', 1)->whereIn('cint_1', $brand_ids)->orderBy('order')->get();
            }


            foreach( $brands as $brand ){
                if( $brand->detail ){
                    $name = strip_tags($brand->detail->name);
                    $brand_data[] = [
                        'id' => $brand->cint_1,
                        'name' => $name,
                        'url' => strip_tags(url($brand->detail->url)),
                        'slug' => strip_tags(\Str::slug($name))
                    ];
                }
            }
        }
        $brand_data = collect($brand_data)->sortBy('name')->values();
        return response()->json($brand_data);
    }

    public function getDecors(Request $request, Mediapress $mediapress): JsonResponse
    {
        $decor_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        $category = Category::find($current_category);
        if($category){
            if( $category->category_id == 15 || $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64){
                $page_ids = self::getPageIds($current_category);
                $decor_ids = \DB::table('page_extras')->where('key', 'decor')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();
            }else{
                $detail_ids = self::getPagesDetailsIds($current_category);
                $decor_ids = \DB::table('page_detail_extras')->where('key', 'decor')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
            }

            $decors = \DB::table('pages')
                ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
                ->join('page_details', function($join){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where(function($query){
                            return $query->where('page_details.name', '!=', NULL)
                                ->where('page_details.name', '!=', '-');
                        })
                        ->where('page_details.language_id', $this->language_id)
                        ->where('page_details.country_group_id', $this->country_group_id)
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
                    'name' => $name,
                    'slug' => strip_tags(\Str::slug($name))
                ];
            }
        }
        $decor_data = collect($decor_data)->sortBy('name')->values();
        return response()->json($decor_data);
    }

    public function getTextures(Request $request, Mediapress $mediapress): JsonResponse
    {
        $texture_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        $category = Category::find($current_category);
        if($category){
            $detail_ids = self::getPagesDetailsIds($current_category);
            $texture_ids = \DB::table('page_detail_extras')->where('key', 'texture')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
            $textures = \DB::table('pages')
                ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
                ->join('page_details', function($join){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where(function($query){
                            return $query->where('page_details.name', '!=', NULL)
                                ->where('page_details.name', '!=', '-');
                        })
                        ->where('page_details.language_id', $this->language_id)
                        ->where('page_details.country_group_id', $this->country_group_id)
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
                    'name' => $name,
                    'slug' => strip_tags(\Str::slug($name))
                ];
            }
        }
        $texture_data = collect($texture_data)->sortBy('name')->values();
        return response()->json($texture_data);
    }

    public function getSurfaces(Request $request, Mediapress $mediapress): JsonResponse
    {
        $surface_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        $category = Category::find($current_category);
        if($category){
            if( $category->category_id == 15 || $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64){
                $page_ids = self::getPageIds($current_category);
                $surface_ids = \DB::table('page_extras')->where('key', 'surface')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();
            }else{
                $detail_ids = self::getPagesDetailsIds($current_category);
                $surface_ids = \DB::table('page_detail_extras')->where('key', 'surface')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
            }

            $surfaces = \DB::table('pages')
                ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
                ->join('page_details', function($join){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where(function($query){
                            return $query->where('page_details.name', '!=', NULL)
                                ->where('page_details.name', '!=', '-');
                        })
                        ->where('page_details.language_id', $this->language_id)
                        ->where('page_details.country_group_id', $this->country_group_id)
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
                    'name' => $name,
                    'slug' => strip_tags(\Str::slug($name))
                ];
            }
        }
        $surface_data = collect($surface_data)->sortBy('name')->values();
        return response()->json($surface_data);
    }

    public function getLocks(Request $request, Mediapress $mediapress): JsonResponse
    {
        $locks_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        $category = Category::find($current_category);
        if($category){
            $page_ids = self::getPageIds($current_category);
            $lock_ids = \DB::table('page_extras')->where('key', 'lock')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();
            $locks = \DB::table('pages')
                ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
                ->join('page_details', function($join){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where(function($query){
                            return $query->where('page_details.name', '!=', NULL)
                                ->where('page_details.name', '!=', '-');
                        })
                        ->where('page_details.language_id', $this->language_id)
                        ->where('page_details.country_group_id', $this->country_group_id)
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
                    'name' => $name,
                    'slug' => strip_tags(\Str::slug($name))
                ];
            }
        }
        $locks_data = collect($locks_data)->sortBy('name')->values();
        return response()->json($locks_data);
    }

    public function getBevels(Request $request, Mediapress $mediapress): JsonResponse
    {
        $bevels_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        $category = Category::find($current_category);
        if($category){
            $page_ids = self::getPageIds($current_category);
            $bevel_ids = \DB::table('page_extras')->where('key', 'bevel')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();
            $bevels = \DB::table('pages')
                ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
                ->join('page_details', function($join){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where(function($query){
                            return $query->where('page_details.name', '!=', NULL)
                                ->where('page_details.name', '!=', '-');
                        })
                        ->where('page_details.language_id', $this->language_id)
                        ->where('page_details.country_group_id', $this->country_group_id)
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
                    'name' => $name,
                    'slug' => strip_tags(\Str::slug($name))
                ];
            }
        }
        $bevels_data = collect($bevels_data)->sortBy('name')->values();
        return response()->json($bevels_data);
    }

    public function getWaters(Request $request, Mediapress $mediapress): JsonResponse
    {
        $waters_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        $category = Category::find($current_category);
        if($category){
            $detail_ids = self::getPagesDetailsIds($current_category);
            $water_ids = \DB::table('page_detail_extras')->where('key', 'water')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
            $waters = \DB::table('pages')
                ->select('pages.id', 'pages.cint_1', 'page_details.name', 'pages.order','page_details.id as page_detail_id')
                ->join('page_details', function($join){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where(function($query){
                            return $query->where('page_details.name', '!=', NULL)
                                ->where('page_details.name', '!=', '-');
                        })
                        ->where('page_details.language_id', $this->language_id)
                        ->where('page_details.country_group_id', $this->country_group_id)
                        ->where('page_details.deleted_at', NULL);
                })
                ->where('pages.status', 1)
                ->whereIn('pages.id', $water_ids)
                ->whereNull('pages.deleted_at')
                ->orderBy('pages.order')
                ->get();

            foreach( $waters as $water ){
                $name = strip_tags($water->name);
                $waters_data[] = [
                    'id' => $water->id,
                    'order' => $water->order,
                    'name' => $name,
                    'slug' => strip_tags(\Str::slug($name))
                ];
            }
        }
        $waters_data = collect($waters_data)->sortBy('order')->values();
        return response()->json($waters_data);
    }

    public function getDimensions(Request $request, Mediapress $mediapress): JsonResponse
    {
        $dimension_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        $category = Category::find($current_category);
        if($category){
            $detail_ids = self::getPagesDetailsIds($current_category);
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
                    'name' => $dimension->cvar_1,
                    'slug' => strip_tags(\Str::slug($dimension->cvar_1))
                ];
            }
        }
        return response()->json($dimension_data);

    }

    public function getThickness(Request $request, Mediapress $mediapress): JsonResponse
    {
        $thickness_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        $category = Category::find($current_category);
        if($category){
            $page_ids = self::getPageIds($current_category, $this->language_id, $this->country_group_id);
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
                $thickness_data[] = [
                    'id' => $thickness->id,
                    'name' => $thickness->cvar_1,
                    'slug' => strip_tags(\Str::slug($thickness->cvar_1))
                ];
            }
        }
        return response()->json($thickness_data);

    }

    public function getHeights(Request $request, Mediapress $mediapress): JsonResponse
    {
        $height_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        $category = Category::find($current_category);
        if($category){
            $page_ids = self::getPageIds($current_category);
            $heights = \DB::table('page_extras')->where('key', 'height')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();

            foreach( $heights as $height ){
                $height_data[] = [
                    'id' => $height,
                    'name' => $height,
                    'slug' => strip_tags(\Str::slug($height))
                ];
            }
        }
        return response()->json($height_data);

    }

    public function getClasses(Request $request, Mediapress $mediapress): JsonResponse
    {
        $class_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        $category = Category::find($current_category);
        if($category){
            $page_ids = self::getPageIds($current_category);
            $classes = \DB::table('page_extras')->where('key', 'class')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();

            foreach( $classes as $class ){
                $checkifExists = \DB::table('pages')
                    ->select(
                        'pages.id',
                        'pages.cvar_1',
                        'page_details.name',
                    )
                    ->join('page_details', function($join)use($mediapress){
                        $join->on('page_details.page_id', '=', 'pages.id')
                            ->where('page_details.language_id', $mediapress->activeLanguage->id)
                            ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
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
                        'name' => $class,
                        'slug' => strip_tags(\Str::slug($class))
                    ];
                }

            }
        }
        $class_data = collect($class_data)->sortBy('name')->values();
        return response()->json($class_data);
    }

    public function getExtraFeatures(Request $request, Mediapress $mediapress): JsonResponse
    {
        $features_data = [];

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $current_category = $request->input('category_id');
        if($current_category){
            $detail_ids = self::getPagesDetailsIds($current_category);
            $feature_ids = \DB::table('page_detail_extras')->where('key', 'extra_feature')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
            $features = \DB::table('pages')
                ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id')
                ->join('page_details', function($join){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where(function($query){
                            return $query->where('page_details.name', '!=', NULL)
                                ->where('page_details.name', '!=', '-');
                        })
                        ->where('page_details.language_id', $this->language_id)
                        ->where('page_details.country_group_id', $this->country_group_id)
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
                    'name' => $name,
                    'slug' => strip_tags(\Str::slug($name))
                ];
            }
        }
        $features_data = collect($features_data)->sortBy('name')->values();
        return response()->json($features_data);
    }

    public function filterProducts(Request $request, Mediapress $mediapress): JsonResponse
    {
        if( is_null($this->language_id) || is_null($this->country_group_id) ){
            return response()->json(['status' => 0]);
            exit;
        }

        $mediapress->activeCountryGroup = CountryGroup::find($this->country_group_id);
        $mediapress->activeLanguage = Language::find($this->language_id);
        $data = $request->input('product_data');
        $category = $request->input('category_id');
        $parent_category = $request->input('parent_category_id');
        $products_data = [];
        $products = \DB::table('pages')
            ->select(
                'pages.id',
                'pages.cint_1 as brand',
                'pages.cint_3 as decor_code',
                'pages.cint_4',
                'pages.cvar_2',
                'pages.order',
                'page_details.id as page_detail_id',
                'page_details.name',
                'categories.id as category_id',
                'category_details.name as category_details_name',
                'urls.url',
                'decor_image.mfile_id as decor_image_id',
                'interior_image.mfile_id as interior_image_id'
            )
            ->join('page_details', function($join)use($data){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '!=', NULL)
                    ->where('page_details.language_id', $this->language_id)
                    ->where('page_details.country_group_id', $this->country_group_id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->join('category_page', function($join){
                $join->on('category_page.page_id', '=', 'pages.id');
            })
            ->join('categories', function($join)use($category,$parent_category){
                if( $category == 5 || $category == 11 || $parent_category == 15 || $category == 2 ){
                    $join->on('categories.id', '=' ,'category_page.category_id')
                        ->where('categories.category_id', $category)
                        ->where(function($query){
                            return $query->whereNull('categories.cint_3')->orWhere('categories.cint_3', 0);
                        });
                }else{
                    $join->on('categories.id', '=' ,'category_page.category_id')
                        ->where('categories.id', $category);
                }

            })
            ->join('category_details', function($join){
                $join->on('category_details.category_id', '=', 'categories.id');
                $join->where('category_details.language_id', $this->language_id)
                    ->where('category_details.country_group_id', $this->country_group_id)
                    ->whereNull('category_details.deleted_at');
            })
            ->join('urls', function($join){
                $join->on('urls.model_id', '=', 'page_details.id')
                    ->where('urls.type', 'original')
                    ->where('urls.model_type', 'Mediapress\Modules\Content\Models\PageDetail')
                    ->whereNull('urls.deleted_at');
            })
            ->leftJoin('mfile_general as decor_image', function($join){
                $join->on('decor_image.model_id', '=', 'pages.id')->where('decor_image.file_key', 'cover')->where('decor_image.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->leftJoin('mfile_general as interior_image', function($join){
                $join->on('interior_image.model_id', '=', 'pages.id')->where('interior_image.file_key', 'interior')->where('interior_image.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->where('pages.sitemap_id', PRODUCT_ST_ID)
            ->where('pages.status', 1)
            ->when($data['brand'] && $category != 5 && $parent_category != 5, function($query)use($data){
                return $query->whereIn('pages.cint_1', $data['brand']);
            })
            ->when($data['is_new'], function($query)use($data){
                return $query->where('pages.cint_4', 1);
            })
            ->when($data['query'] != "", function($query)use($data,$parent_category){
                return $query->where('page_details.name', 'like', $data['query'].'%')->orWhere('pages.cint_3', 'like', $data['query'].'%');

            })
            ->get();
        $settings = Sitemap::find(1);
        foreach( $products as $product ){
            if( $product->category_id == 14 ){
                $brand_ids = [$product->brand];
                $brand = \DB::table('pages')
                    ->select(
                        'pages.id',
                        'pages.cint_1',
                        'page_details.name'
                    )
                    ->join('page_details', function($join){
                        $join->on('page_details.page_id', '=', 'pages.id')
                            ->where('page_details.name', '!=', NULL)
                            ->where('page_details.language_id', $this->language_id)
                            ->where('page_details.country_group_id', $this->country_group_id)
                            ->where('page_details.deleted_at', NULL);
                    })
                    ->where('pages.sitemap_id', BRANDS_ST_ID)
                    ->where('pages.status', 1)
                    ->where('pages.cint_1', $product->brand)
                    ->first();
            }else{
                $brand_ids = self::getBrandIds($product);
                $brand = \DB::table('pages')
                    ->select(
                        'pages.id',
                        'pages.cint_1',
                        'page_details.name'
                    )
                    ->join('page_details', function($join){
                        $join->on('page_details.page_id', '=', 'pages.id')
                            ->where('page_details.name', '!=', NULL)
                            ->where('page_details.language_id', $this->language_id)
                            ->where('page_details.country_group_id', $this->country_group_id)
                            ->where('page_details.deleted_at', NULL);
                    })
                    ->where('pages.sitemap_id', BRANDS_ST_ID)
                    ->where('pages.status', 1)
                    ->whereIn('pages.cint_1', $brand_ids)
                    ->first();
            }

            if(isset($brand->name)){
                $brandName = $brand->name;
                $brandData = $brand_ids;
            }else{
                $brandName = false;
                $brandData = [];
            }
            $image_path_check = false;
            if( $parent_category == 5 || $category == 5 ){
                if($brand){
                    $image_path = 'assets/img/galeri/'. str_replace(" ","",$product->decor_code).'-1-1-'.$brand->id.'.jpg';
                    if( \File::exists(public_path($image_path)) ){
                        $image_path_check = true;
                    }
                    $interior_image = asset($image_path);
                }
            }else{
                $image_path = 'assets/img/galeri/'. str_replace(" ","",$product->decor_code).'-1.jpg';
                if( \File::exists(public_path($image_path)) ){
                    $image_path_check = true;
                }
                $interior_image = asset($image_path);
            }
            if( $mediapress->activeCountryGroup->code == 'ru' ){
                $image_path = 'assets/img/galeri/'. str_replace(" ","",$product->decor_code).'-1-5.jpg';
                if( \File::exists(public_path($image_path)) ){
                    $image_path_check = true;
                }else{
                    $image_path_check = false;
                }
                $interior_image = asset($image_path);
            }
            if( $mediapress->activeCountryGroup->code == 'rg' ){
                $image_path = 'assets/img/galeri/'. str_replace(" ","",$product->decor_code).'-1-7.jpg';
                if( \File::exists(public_path($image_path)) ){
                    $image_path_check = true;
                }else{
                    $image_path_check = false;
                }
                $interior_image = asset($image_path);
            }
            $decor_image = 'assets/img/decors/'. str_replace(" ", "", $product->decor_code).'.jpg';
            if( $product->decor_image_id ){
                $decor_image = get_image($product->decor_image_id);
            }else if( \File::exists(public_path($decor_image)) ){
                $decor_image = asset($decor_image);
            }else{
                $decor_image = image($settings->f_default_decor)->originalUrl;
            }
            if( $product->interior_image_id ){
                $interior_image = get_image($product->interior_image_id);
                $image_path_check = true;
            }

            $products_data[] = [
                'name' => $product->name,
                'category' => $product->category_details_name,
                'decor_code' => $product->decor_code,
                'url' => url($product->url),
                'image' => $category != 11 || $parent_category != 11 || $category != 2 || $parent_category != 2 ? resizeImage($decor_image, ['w'=>281,'h'=>281])->baseUrl : $decor_image,
                'image_interior' => $interior_image ?? null,
                'image_interior_exists' => $image_path_check,
                'brand' => $brandName,
                'page_detail_id' => $product->page_detail_id,
                'decors' => self::getDecorIds($product, $parent_category),
                'surfaces' => self::getSurfaceIds($product, $parent_category),
                'textures' => self::getTextureIds($product, $parent_category),
                'waters' => self::getWaterIds($product, $parent_category),
                'extra_features' => self::getExtraFeaturesIds($product),
                'dimensions' => self::getDimensionsIds($product),
                'thicknesses' => self::getThicknessIds($product),
                'locks' => self::getLockIds($product),
                'bevels' => self::getBevelIds($product),
                'classes' => self::getClassesIds($product),
                'heights' => self::getHeightIds($product),
                'brands' => $brandData,
                'is_new' => $product->cint_4 == 1 ?? false,
                'is_coming_soon' => $product->cvar_2 == 1 ?? false,
                'order' => $product->order
            ];
        }
        $results = collect($products_data);

        if( $data['brand'] && ($category == 5 || $parent_category == 5) ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['brand'], $collection['brands']));
            });
        }

        if( $data['decor'] ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['decor'], $collection['decors']));
            });
        }

        if( $data['surface'] ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['surface'], $collection['surfaces']));
            });
        }

        if( $data['texture'] ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['texture'], $collection['textures']));
            });
        }

        if( $data['water'] ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['water'], $collection['waters']));
            });
        }

        if( $data['extra_feature'] ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['extra_feature'], $collection['extra_features']));
            });
        }

        if( $data['dimension'] ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['dimension'], $collection['dimensions']));
            });
        }

        if( $data['thickness'] ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['thickness'], $collection['thicknesses']));
            });
        }

        if( $data['lock'] ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['lock'], $collection['locks']));
            });
        }

        if( $data['bevel'] ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['bevel'], $collection['bevels']));
            });
        }

        if( $data['class'] ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['class'], $collection['classes']));
            });
        }

        if( $data['height'] ){
            $results = $results->filter(function($collection) use($data){
                return count(array_intersect($data['height'], $collection['heights']));
            });
        }
        $is_new = $results->where('is_new', 1)->count();
        $results = $results->sortBy(function ($item) {
            return [
                !$item['is_coming_soon'],
                !$item['is_new'],
                $item['decor_code']
            ];
        })
            ->values();
        return response()->json([
            'status' => 1,
            'data' => $results,
            'is_new' => $is_new
        ]);
    }

    private function getDecorIds($product, $parent_category): array
    {
        $decor_data = [];
        if($parent_category == 15 || $parent_category == 16 || $parent_category == 41 || $parent_category == 60 || $parent_category == 64 || $parent_category == 72){
            $decors = \DB::table('page_extras')
                ->where('page_id', $product->id)
                ->where('key', 'decor')
                ->get()
                ->pluck('value');
        }else{
            $decors = \DB::table('page_detail_extras')
                ->where('page_detail_id', $product->page_detail_id)
                ->where('key', 'decor')
                ->get()
                ->pluck('value');
        }

        foreach( $decors as $decor ){
            array_push($decor_data, intval($decor));
        }

        return $decor_data;
    }

    private function getSurfaceIds($product, $parent_category): array
    {
        $surface_data = [];
        if($parent_category == 15 || $parent_category == 16 || $parent_category == 41 || $parent_category == 60 || $parent_category == 64){
            $surfaces = \DB::table('page_extras')
                ->where('page_id', $product->id)
                ->where('key', 'surface')
                ->get()
                ->pluck('value');
        }else{
            $surfaces = \DB::table('page_detail_extras')
                ->where('page_detail_id', $product->page_detail_id)
                ->where('key', 'surface')
                ->get()
                ->pluck('value');
        }
        foreach( $surfaces as $surface ){
            array_push($surface_data, intval($surface));
        }

        return $surface_data;
    }

    private function getTextureIds($product, $parent_category): array
    {
        $texture_data = [];
        $textures = \DB::table('page_detail_extras')
            ->where('page_detail_id', $product->page_detail_id)
            ->where('key', 'texture')
            ->get()
            ->pluck('value');
        foreach( $textures as $texture ){
            $texture_data[] = intval($texture);
        }

        return $texture_data;
    }

    private function getWaterIds($product, $parent_category): array
    {
        $water_data = [];
        $waters = \DB::table('page_detail_extras')
            ->where('page_detail_id', $product->page_detail_id)
            ->where('key', 'water')
            ->get()
            ->pluck('value');
        foreach( $waters as $water ){
            $water_data[] = intval($water);
        }

        return $water_data;
    }

    private function getBrandIds($product): array
    {
        $brand_data = [];
        $brands = \DB::table('page_detail_extras')
            ->where('page_detail_id', $product->page_detail_id)
            ->where('key', 'brand')
            ->get()
            ->pluck('value');
        foreach( $brands as $brand ){
            array_push($brand_data, intval($brand));
        }

        return $brand_data;
    }

    private function getExtraFeaturesIds($product): array
    {
        $feature_data = [];
        $features = \DB::table('page_detail_extras')
            ->where('page_detail_id', $product->page_detail_id)
            ->where('key', 'extra_feature')
            ->get()
            ->pluck('value');
        foreach( $features as $feature ){
            array_push($feature_data, intval($feature));
        }

        return $feature_data;
    }

    private function getFeaturesIds($product): array
    {
        $feature_data = [];
        $features = \DB::table('page_detail_extras')
            ->where('page_detail_id', $product->page_detail_id)
            ->where('key', 'features')
            ->get()
            ->pluck('value');
        foreach( $features as $feature ){
            array_push($feature_data, intval($feature));
        }

        return $feature_data;
    }

    private function getCertificateIds($product): array
    {
        $certificate_data = [];
        $certificates = \DB::table('page_detail_extras')
            ->where('page_detail_id', $product->page_detail_id)
            ->where('key', 'certificate')
            ->get()
            ->pluck('value');
        foreach( $certificates as $certificate ){
            array_push($certificate_data, intval($certificate));
        }

        return $certificate_data;
    }

    private function getFeatureIds($product): array
    {
        $feature_data = [];
        $features = \DB::table('page_detail_extras')
            ->where('page_detail_id', $product->page_detail_id)
            ->where('key', 'feature')
            ->get()
            ->pluck('value');
        foreach( $features as $feature ){
            array_push($feature_data, intval($feature));
        }

        return $feature_data;
    }

    private function getDimensionsIds($product): array
    {
        $dimension_data = [];
        $dimensions = \DB::table('page_detail_extras')
            ->where('page_detail_id', $product->page_detail_id)
            ->where('key', 'dimension')
            ->get()
            ->pluck('value')
            ->unique();

        foreach( $dimensions as $dimension ){
            array_push($dimension_data, $dimension);
        }

        return $dimension_data;
    }

    private function getThicknessIds($product): array
    {
        $thickness_data = [];
        $thicknesses = \DB::table('page_extras')
            ->where('page_id', $product->id)
            ->where('key', 'thickness')
            ->get()
            ->pluck('value');

        foreach( $thicknesses as $thickness ){
            array_push($thickness_data, $thickness);
        }

        return $thickness_data;
    }

    private function getLockIds($product): array
    {
        $lock_data = [];
        $locks = \DB::table('page_extras')
            ->where('page_id', $product->id)
            ->where('key', 'lock')
            ->get()
            ->pluck('value');

        foreach( $locks as $lock ){
            array_push($lock_data, $lock);
        }

        return $lock_data;
    }

    private function getBevelIds($product): array
    {
        $bevel_data = [];
        $bevels = \DB::table('page_extras')
            ->where('page_id', $product->id)
            ->where('key', 'bevel')
            ->get()
            ->pluck('value');

        foreach( $bevels as $bevel ){
            array_push($bevel_data, $bevel);
        }

        return $bevel_data;
    }

    private function getClassesIds($product): array
    {
        $class_data = [];
        $classes = \DB::table('page_extras')
            ->where('page_id', $product->id)
            ->where('key', 'class')
            ->get()
            ->pluck('value');

        foreach( $classes as $class ){
            array_push($class_data, $class);
        }

        return $class_data;
    }

    private function getHeightIds($product): array
    {
        $height_data = [];
        $heights = \DB::table('page_extras')
            ->where('page_id', $product->id)
            ->where('key', 'height')
            ->get()
            ->pluck('value');

        foreach( $heights as $height ){
            array_push($height_data, $height);
        }

        return $height_data;
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

    private function getPageIds($current_category, $language_id = null, $country_group = null)
    {

        $category = Category::find($current_category);
        return \DB::table('pages')
            ->select(
                'pages.id as page_id',
                'categories.id as category_id'
            )
            ->join('category_page', function($join){
                $join->on('category_page.page_id', '=', 'pages.id');
            })
            ->join('categories', function($join)use($category){
                if( $category->category_id == 15 ){
                    $join->on('categories.id', '=' ,'category_page.category_id')
                        ->where('categories.category_id', $category->id);
                }else{
                    $join->on('categories.id', '=' ,'category_page.category_id')
                        ->where('categories.id', $category->id);
                }

            })
            ->when(!is_null($language_id) && !is_null($country_group), function($query)use($language_id, $country_group){
                $query->join('page_details', function($join)use($language_id, $country_group){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where('page_details.language_id', $language_id)
                        ->where('page_details.country_group_id', $country_group)
                        ->whereNull('page_details.deleted_at')
                        ->where('page_details.name', '<>', '')
                        ->where('page_details.name', '!=', '-');
                });
            })
            ->where('pages.sitemap_id', PRODUCT_ST_ID)
            ->where('pages.status', 1)
            ->get()
            ->pluck('page_id');
    }

    private function getPagesDetailsIds($current_category)
    {
        return \DB::table('pages')
            ->select(
                'pages.id',
                'page_details.id as page_detail_id',
                'categories.id as category_id'
            )
            ->join('page_details', function($join){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '!=', NULL)
                    ->where('page_details.language_id', $this->language_id)
                    ->where('page_details.country_group_id', $this->country_group_id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->join('category_page', function($join){
                $join->on('category_page.page_id', '=', 'pages.id');
            })
            ->join('categories', function($join)use($current_category){
                if( $current_category == 5 || $current_category == 11 || $current_category == 16 || $current_category == 2){
                    $join->on('categories.id', '=' ,'category_page.category_id')
                        ->where('categories.category_id', $current_category);
                }else{
                    $join->on('categories.id', '=' ,'category_page.category_id')
                        ->where('categories.id', $current_category);
                }

            })
            ->where('pages.sitemap_id', PRODUCT_ST_ID)
            ->where('pages.status', 1)
            ->get()
            ->pluck('page_detail_id');
    }

    private function getClassifications($mediapress): array
    {
        $classification_data = [];
        $classifications = \DB::table('pages')->select(
            'pages.id',
            'pages.cint_1',
            'pages.cint_2',
            'page_details.name',
            'page_details.detail'
        )
            ->join('page_details', function($join)use($mediapress){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '!=', NULL)
                    ->where('page_details.language_id', $mediapress->activeLanguage->id)
                    ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->where('pages.sitemap_id', CLASSIFICATION_ST_ID)
            ->where('pages.status', 1)
            ->orderBy('order')
            ->get()
            ->groupBy('cint_1');

        foreach( $classifications as $key => $classificationList ){
            foreach( $classificationList as $classification ){
                $classification_data[$key][] = [
                    'list' => $classification->cint_2,
                    'category' => $classification->cint_1,
                    'name' => $classification->name,
                    'detail' => strip_tags($classification->detail)
                ];
            }

        }
        return $classification_data;
    }

    private function getSurfacesArray($category, $mediapress): array
    {
        $surface_data = [];
        if($category){
            if( $category->category_id == 15 || $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64 ){
                $page_ids = self::getPageIds($category->id);
                $surface_ids = \DB::table('page_extras')->where('key', 'surface')->whereIn('page_id', $page_ids)->get()->pluck('value')->unique()->toArray();
            }else{
                $this->language_id = $mediapress->activeLanguage->id;
                $this->country_group_id = $mediapress->activeCountryGroup->id;
                $detail_ids = self::getPagesDetailsIds($category->id);
                $surface_ids = \DB::table('page_detail_extras')->where('key', 'surface')->whereIn('page_detail_id', $detail_ids)->get()->pluck('value')->unique()->toArray();
            }

            $surfaces = Page::where('status', 1)
                ->whereIn('id', $surface_ids)
                ->whereHas('detail', function($query){
                    return $query->where('name', '!=', '-');
                })
                ->orderBy('order')->get();

            foreach( $surfaces as $surface ){
                $surface_data[] = [
                    'name' => strip_tags($surface->detail->name),
                    'image' => strip_tags(image($surface->f_))
                ];
            }
        }
        return $surface_data;
    }
}
