<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\Sitemap;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Mediapress $mediapress)
    {

        view()->composer('web.pages.product.category', function($view){
            $country_detail = self::getIpDetail();
            $view->with([
                'country_detail' => $country_detail,
            ]);
        });

        view()->composer('web.inc.header', function($view) use ($mediapress){
            $cg = $mediapress->activeCountryGroup;
            $lg = $mediapress->activeLanguage;
            $countries = self::getLanguagesGroupByCountries($cg,$lg);
            $panelCategories = self::getCategoryMenu($cg,$lg,1);
            $parkeCategories = self::getCategoryMenu($cg,$lg,15);
            $country_detail = self::getIpDetail();
            $social_medias = self::getSocialMedias($cg,$lg);
            $ua = new \Mediapress\Foundation\UserAgent\UserAgent();
            $device = $ua->getDevice();
            $view->with([
                'countries' => $countries,
                'panel_categories' => $panelCategories,
                'parke_categories' => $parkeCategories,
                'country_detail' => $country_detail,
                'social_medias' => $social_medias,
                'device' => $device
            ]);
        });
        view()->composer('web.inc.footer', function($view) use ($mediapress){
            $cg = $mediapress->activeCountryGroup;
            $lg = $mediapress->activeLanguage;
            $footer_country = self::getFooterCountry();
            $footer_language = self::getFooterLanguage($lg);
            $stores = self::getFooterStores($cg,$lg);
            $social_medias = self::getSocialMedias($cg,$lg);
            $homePage = Sitemap::find(1);
            $KvkkText = $homePage->detail->detail ?? "";
            $crm_brands = self::getBultenbrands($cg,$lg);
            $ua = new \Mediapress\Foundation\UserAgent\UserAgent();
            $device = $ua->getDevice();
            $view->with([
                'footer_country' => $footer_country,
                'footer_language' => $footer_language,
                'stores' => $stores,
                'social_medias' => $social_medias,
                'kvkk_text' => $KvkkText,
                'crm_brands' => $crm_brands,
                'device' => $device
            ]);
        });
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
    }

    private function getLanguagesGroupByCountries($cg,$lg)
    {

        return Cache::remember('countries_provider_'.$cg->code.'_'.$lg->code, 7*24*60*60, function(){
            $country_data = [];
            $countries = \DB::table('countries')->orderBy('native')->get();
            foreach($countries as $country){
                $countryGroupCountry = \DB::table('country_group_country')->where('country_code', $country->code)->first();
                if( $countryGroupCountry ){
                    $groupItem = \DB::table('country_groups')->where('id', $countryGroupCountry->country_group_id)->first();
                    $country_data[] = [
                        'slug' => $groupItem->id,
                        'name' => $country->native,
                        'code' => $country->id
                    ];
                }else{
                    $country_data[] = [
                        'slug' => 1,
                        'name' => $country->native,
                        'code' => $country->id
                    ];
                }
            }
            return $country_data;
        });

    }

    private function getIpDetail()
    {

        if( session('selected_country_code') ){
            $ipDetails = session('selected_country_code');
        }else{
            $ipDetails = ip_details();
            if ($ipDetails) {
                if(isset($ipDetails["country"])){
                    $country_code = $ipDetails["country"]["iso_code"];
                    $country = \DB::table('countries')->where('code', $country_code)->first();
                    $ipDetails = $country->id;
                }else{
                    $ipDetails = null;
                }
            }else{
                $ipDetails = null;
            }
        }

        return $ipDetails;
    }

    private function getCategoryMenu($cg,$lg,$category_id)
    {
        return Cache::remember('get_category_by_id_'.$cg->code.'_'.$lg->code.'_'.$category_id, 7*24*60*60, function()use($cg,$lg,$category_id){
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
                        ->where('category_details.name', '!=', NULL)
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
                ->whereNull('categories.deleted_at')
                ->get();

            $category_result = self::transformCategoriesForMenu($categories);
            return $category_result;
        });
    }

    private function transformCategoriesForMenu($categories): array
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
                'url' => url($category->url),
                'image' => $image,
                'detail' => $category->detail
            ];
        }

        return $category_data;
    }

    private function getFooterCountry()
    {
        $country = self::getIpDetail();
        $country_name = false;
        if( !is_null($country) ){
            $country = \DB::table('countries')->where('id', $country)->first();
            if( $country ){
                $country_name = $country->native;
            }
        }

        return $country_name;
    }

    private function getFooterLanguage($lg)
    {
        $language = \DB::table('languages')->where('code', $lg->code)->first();
        return $language->name;
    }

    private function getFooterStores($cg,$lg)
    {
        return Cache::remember('footer_stores_'.$cg->code.'_'.$lg->code, 7*24*60*60, function(){
            $sitemap = Sitemap::find(1);
            $sitemap_detail = $sitemap->detail;
            $store_data['footer_app_store'] = isset($sitemap_detail->footer_app_store) && strip_tags($sitemap_detail->footer_app_store) != "" ? strip_tags($sitemap_detail->footer_app_store) : false;
            $store_data['footer_google_store_url'] = isset($sitemap_detail->footer_google_store_url) && strip_tags($sitemap_detail->footer_google_store_url) != "" ? strip_tags($sitemap_detail->footer_google_store_url) : false;
            return $store_data;
        });
    }

    private function getSocialMedias($cg,$lg)
    {
        return Cache::remember('social_medias_'.$cg->code.'_'.$lg->code, 7*24*60*60, function()use($cg, $lg){
            $media_data = [];
            $social_medias = \DB::table('pages')
                ->select(
                    'pages.id',
                    'page_details.id as page_detail_id',
                    'page_details.name',
                    'media_url.value as url',
                    'icon_image.mfile_id as icon_image_id',
                )
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
                ->join('page_detail_extras as media_url', function($join){
                    $join->on('media_url.page_detail_id', '=', 'page_details.id')
                        ->where('media_url.key', 'media_url')
                        ->where('media_url.value', '!=', "");
                })
                ->leftJoin('mfile_general as icon_image', function($join){
                    $join->on('icon_image.model_id', '=', 'pages.id')->where('icon_image.file_key', 'cover')->where('icon_image.model_type', 'Mediapress\Modules\Content\Models\Page');
                })
                ->where('pages.status', 1)
                ->where('sitemap_id', SOCIAL_MEDIA_ST_ID)
                ->get();

            foreach( $social_medias as $media ){
                $media_data[] = [
                    'name' => $media->name,
                    'url' => $media->url,
                    'image' => !is_null($media->icon_image_id) ? get_image($media->icon_image_id) :null
                ];
            }

            return $media_data;
        });
    }

    private function getBultenbrands($cg,$lg)
    {
        return Cache::remember('ebulten_brands_'.$cg->code.'_'.$lg->code, 7*24*60*60, function()use($cg, $lg){
            $crm_data = [];
            $pages = \DB::table('pages')
                ->select(
                    'pages.id',
                    'pages.cint_1',
                    'page_details.name'
                )
                ->join('page_details', function($join)use($cg,$lg){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where(function($query){
                            return $query->where('page_details.name', '!=', NULL)
                                ->where('page_details.name', '<>', '')
                                ->where('page_details.name', '!=', '-');
                        })
                        ->where('page_details.language_id', $lg->id)
                        ->where('page_details.country_group_id', $cg->id)
                        ->where('page_details.deleted_at', NULL);
                })
                ->where('pages.status', 1)
                ->where('sitemap_id', CRM_EBULTEN_BRANDS_ST_ID)
                ->get();

            foreach( $pages as $page ){
                $crm_data[] = [
                    'id' => $page->cint_1,
                    'name' => $page->name,
                ];
            }

            return $crm_data;
        });
    }
}
