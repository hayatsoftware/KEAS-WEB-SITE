<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\Page;

class HomepageController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {
        if( request()->input('itemnumber') ){
            $page_id = request()->input('itemnumber');
            $page = Page::find($page_id);
            if($page){
                return redirect($page->detail->url, 301);
            }else{
                return redirect(getUrlBySitemapId(1), 301);
            }
        }
        $ua = new \Mediapress\Foundation\UserAgent\UserAgent();
        $device = $ua->getDevice();
        $mediapress->data['sitemap'] = $mediapress->parent;
        $mediapress->data['sliders'] = self::getSlider($mediapress);
        $mediapress->data['categories'] = self::getMainCategories($mediapress, $device);
        $mediapress->data['trends'] = self::getTrends($mediapress, $device);
        $mediapress->data['app_sliders'] = self::getAppSliders($mediapress, $device);
        $mediapress->data['boxes'] = self::getHomepageBoxes($mediapress);
        return view('web.pages.homepage.sitemap', compact('mediapress', 'device'));
	}

    private function getSlider($mediapress)
    {
        $slider_data = [];
        $sliders = Page::where('sitemap_id', HOMEPAGE_SLIDER_ST_ID)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->whereNull('deleted_at')
                    ->whereHas('extras', function($query){
                        return $query->where('key', 'summary');
                    });
            })
            ->orderBy('order')
            ->where('status', 1)
            ->get();
        foreach( $sliders as $slider ){
            $detail = $slider->detail;
            $image = null;
            if( $slider->f_ ){
                $image = image($slider->f_)->originalUrl;
            }
            if( $detail->f_ ){
                $image = image($detail->f_)->originalUrl;
            }
            if(is_array($detail->summary)){
                $detail_summary = !empty(strip_tags($detail->summary[0])) ? strip_tags($detail->summary[0]) : null;
            }else{
                $detail_summary = !empty(strip_tags($detail->summary)) ? strip_tags($detail->summary) : null;
            }
            if(is_array($detail->summary_two)){
                $detail_summary_two = !empty(strip_tags($detail->summary_two[0])) ? strip_tags($detail->summary_two[0]) : null;
            }else{
                $detail_summary_two = !empty(strip_tags($detail->summary_two)) ? strip_tags($detail->summary_two) : null;
            }
            if(is_array($detail->summary_three)){
                $detail_summary_three = !empty(strip_tags($detail->summary_three[0])) ? strip_tags($detail->summary_three[0]) : null;
            }else{
                $detail_summary_three = !empty(strip_tags($detail->summary_three)) ? strip_tags($detail->summary_three) : null;
            }
            if(is_array($detail->button_text)){
                $detail_button_text = !empty(strip_tags($detail->button_text[0])) ? strip_tags($detail->button_text[0]) : null;
            }else{
                $detail_button_text = !empty(strip_tags($detail->button_text)) ? strip_tags($detail->button_text) : null;
            }
            if(is_array($detail->button_url)){
                $detail_button_url = !empty(strip_tags($detail->button_url[0])) ? strip_tags($detail->button_url[0]) : null;
            }else{
                $detail_button_url = !empty(strip_tags($detail->button_url)) ? strip_tags($detail->button_url) : null;
            }


            if(!empty(strip_tags($detail->button_url))){
                $detail_button_url = is_array($detail->button_url) ? strip_tags($detail->button_url[0]) : strip_tags($detail->button_url) ;
            }

            $slider_data[] = [
                'type' => $slider->cint_1 == 1 ? 'video':'image',
                'video_url' => strip_tags($slider->cvar_1),
                'video_layer_image' => image($detail->f_layer_image)->originalUrl,
                'slider_image' => resizeImage($image, ['w'=>1920,'h'=>815]),
                'video_slogan' => strip_tags($detail->name),
                'line_text_one' => $detail_summary ?? null,
                'line_text_two' => $detail_summary_two ?? null,
                'line_text_three' => $detail_summary_three ?? null,
                'button_text' => $detail_button_text ?? null,
                'button_url' => $detail_button_url ?? null
            ];

        }
        return $slider_data;
    }

    private function getMainCategories($mediapress, $device)
    {
        return Cache::remember('homepage_categories_'.$mediapress->activeLanguage->code.'_'.$mediapress->activeCountryGroup->code, 7*24*60*60, function()use($mediapress, $device){
            $category_data = [];
            $categories = Category::whereIn('id', [1,15])->get();
            foreach($categories as $category)
            {
                $image = $category->detail->f_zone_homepage ? image($category->detail->f_zone_homepage) : image($category->f_homepage);

                if($device == 'mobile'){
                    $image = resizeImage($image->originalUrl, ['w'=>170,'h'=>175])->baseUrl;
                }else{
                    $image = resizeImage($image->originalUrl, ['w'=>700,'h'=>500])->baseUrl;
                }

                $detail = $category->detail;
                $category_data[] = [
                    'name' => $detail->name,
                    'url' => $detail->url,
                    'image' => $image,
                    'detail' => strip_tags($detail->detail)
                ];
            }
            return $category_data;
        });
    }

    private function getTrends($mediapress, $device)
    {
        return Cache::remember('homepage_trends_'.$mediapress->activeLanguage->code.'_'.$mediapress->activeCountryGroup->code, 7*24*60*60, function()use($mediapress, $device){
            $page_data = [];
            $pages = Page::where('sitemap_id', BLOG_ST_ID)
                ->where('status', 1)
                ->where('cint_2', 1)
                ->whereHas('details', function($query)use($mediapress){
                    return $query->where('language_id', $mediapress->activeLanguage->id)
                        ->where('country_group_id', $mediapress->activeCountryGroup->id)
                        ->where(function($q){
                            return $q->where('name', '!=', '');
                        });
                })
                ->with(['details'])
                ->orderBy('created_at')
                ->take(10)
                ->get();
            foreach( $pages as $page ){
                $detail = $page->detail;
                if( $detail ){
                    $page_data[] = [
                        'name' => strip_tags($detail->name),
                        'url' => strip_tags($detail->url),
                        'image' => $device == 'mobile' ? resizeImage(image($page->f_)->originalUrl, ['w'=>275,'h'=>300]) : resizeImage(image($page->f_)->originalUrl, ['w'=>505,'h'=>500])
                    ];
                }

            }
            return $page_data;
        });
    }

    private function getAppSliders($mediapress, $device)
    {
        return Cache::remember('homepage_app_sliders_'.$mediapress->activeLanguage->code.'_'.$mediapress->activeCountryGroup->code, 7*24*60*60, function()use($mediapress, $device){
            $page_data = [];
            $pages = Page::where('sitemap_id', HOMEPAGE_APP_SLIDER_ST_ID)
                ->whereHas('details', function($query)use($mediapress){
                    return $query->where('language_id', $mediapress->activeLanguage->id)
                        ->where('country_group_id', $mediapress->activeCountryGroup->id)
                        ->where(function($q){
                            return $q->where('name', '!=', '');
                        });
                })
                ->with(['detail'])
                ->orderBy('order')
                ->where('status', 1)
                ->get();
            foreach( $pages as $page ){
                $detail = $page->detail;
                if( $detail->f_ ){
                    $image = $device == 'mobile' ? resizeImage(image($detail->f_)->originalUrl, ['w'=>390, 'h'=>230])->baseUrl :  resizeImage(image($detail->f_)->originalUrl, ['w'=>1920, 'h'=>700])->baseUrl;
                }else{
                    $image = $device == 'mobile' ? resizeImage(image($page->f_)->originalUrl, ['w'=>390, 'h'=>230])->baseUrl : resizeImage(image($page->f_)->originalUrl, ['w'=>1920, 'h'=>700])->baseUrl;
                }
                if( $detail ){
                    $page_data[] = [
                        'title' => strip_tags($detail->name),
                        'slogan' => $detail->detail,
                        'image' => $image,
                        'app_store' => strip_tags($detail->app_store_url),
                        'google_store' => strip_tags($detail->google_store_url),
                        'button_text' => strip_tags($detail->button_text) && strip_tags($detail->button_text) != "" ? strip_tags($detail->button_text):null,
                        'button_url' => strip_tags($detail->button_url) && strip_tags($detail->button_url) != "" ? strip_tags($detail->button_url):null,
                    ];
                }

            }
            return $page_data;
        });
    }

    private function getHomepageBoxes($mediapress)
    {
        return Cache::remember('homepage_boxes_'.$mediapress->activeLanguage->code.'_'.$mediapress->activeCountryGroup->code, 7*24*60*60, function()use($mediapress){
            $page_data = [];
            $pages = Page::where('sitemap_id', HOMEPAGE_BOXES_ST_ID)
                ->whereHas('details', function($query)use($mediapress){
                    return $query->where('language_id', $mediapress->activeLanguage->id)
                        ->where('country_group_id', $mediapress->activeCountryGroup->id)
                        ->where(function($q){
                            return $q->where('name', '!=', '');
                        });
                })
                ->with(['detail'])
                ->orderBy('order')
                ->where('status', 1)
                ->get();
            foreach( $pages as $page ){
                $detail = $page->detail;
                if( $detail && strip_tags( $detail->name) != ""){
                    $page_data[] = [
                        'name' => strip_tags($detail->name),
                        'detail' => strip_tags($detail->detail),
                        'image' => $page->cint_1 == 1 ? resizeImage(image($page->f_)->originalUrl, ['w'=>700,'h'=>340]):resizeImage(image($page->f_)->originalUrl, ['w'=>455,'h'=>340]),
                        'url' => strip_tags($detail->box_url),
                        'type' => $page->cint_1 == 1 ? 'big':'small'
                    ];
                }

            }
            return $page_data;
        });
    }
}
