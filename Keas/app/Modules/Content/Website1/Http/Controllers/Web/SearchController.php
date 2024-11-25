<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use App\Services\Collection;
use Mediapress\Modules\Content\Models\Sitemap;
use Mediapress\Modules\MPCore\Controllers\SearchController as ParentSearchController;

class SearchController extends ParentSearchController
{
    function SitemapDetail(){

        if(is_null(request()->get('q'))) {
            return redirect()->to($this->mediapress->homePageUrl->url);
        }
        $sitemaps = Sitemap::where('searchable', 1)->get()->pluck('id')->toArray();
        $searchQuery = request()->get('q');
        $mediapress = $this->mediapress;
        $product_pages = collect([]);
        $brand_page = \DB::table('pages')
            ->select(
                'pages.id',
                'pages.cint_1 as brand_id',
                'page_details.name'
            )
            ->join('page_details', function($join)use($mediapress){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '!=', '')
                    ->where('page_details.name', '!=', NULL)
                    ->where('page_details.deleted_at', NULL)
                    ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('page_details.language_id', $mediapress->activeLanguage->id);
            })
            ->where(function($q)use($searchQuery){
                return $q->where('page_details.name', 'like', '%'.$searchQuery.'%')
                    ->orWhere('page_details.search_text', 'like', '%'.$searchQuery.'%');
            })
            ->where('pages.sitemap_id', BRANDS_ST_ID)
            ->first();
        if(!is_null($brand_page)){
            $product_pages = \DB::table('pages')
                ->select(
                    'pages.id',
                    'pages.sitemap_id as page_sitemap_id',
                    'pages.cint_1 as brand',
                    'pages.cint_3 as decor_code',
                    'page_details.id as page_detail_id',
                    'page_details.name as title',
                    'page_details.detail as description',
                    'urls.url as detail_url',
                    'cover_image.mfile_id as cover_image_id',
                    'cover_image.mfile_id as cover_detail_image_id',
                    'page_detail_extras.value as brand'
                )
                ->join('page_details', function($join)use($mediapress){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where('page_details.name', '<>', '')
                        ->where('page_details.name', '!=', NULL)
                        ->where('page_details.deleted_at', NULL)
                        ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                        ->where('page_details.language_id', $mediapress->activeLanguage->id);
                })
                ->join('page_detail_extras', function($join)use($brand_page){
                    $join->on('page_detail_extras.page_detail_id', '=', 'page_details.id')
                        ->where('key', 'brand')->where('value', $brand_page->brand_id);
                })
                ->join('urls', function($join){
                    $join->on('urls.model_id', '=', 'page_details.id')->where('type', 'original')->where('urls.model_type', '!=', 'Mediapress\Modules\Content\Models\CategoryDetail');
                })
                ->leftJoin('mfile_general as interior_image', function($join){
                    $join->on('interior_image.model_id', '=', 'pages.id')
                        ->where('interior_image.file_key', 'interior')
                        ->where('interior_image.model_type', 'Mediapress\Modules\Content\Models\Page');
                })
                ->leftJoin('mfile_general as cover_image', function($join){
                    $join->on('cover_image.model_id', '=', 'pages.id')
                        ->where('cover_image.file_key', 'cover')
                        ->where('cover_image.model_type', 'Mediapress\Modules\Content\Models\Page');
                })
                ->leftJoin('mfile_general as cover_detail_image', function($join){
                    $join->on('cover_detail_image.model_id', '=', 'page_details.id')
                        ->where('cover_detail_image.file_key', 'cover')
                        ->where('cover_detail_image.model_type', 'Mediapress\Modules\Content\Models\PageDetail');
                })
                ->where('pages.sitemap_id', PRODUCT_ST_ID)
                ->get();
        }
        $pages = \DB::table('pages')
            ->select(
                'pages.id',
                'pages.sitemap_id as page_sitemap_id',
                'pages.cint_1 as brand',
                'pages.cint_3 as decor_code',
                'page_details.id as page_detail_id',
                'page_details.name as title',
                'page_details.detail as description',
                'urls.url as detail_url',
                'cover_image.mfile_id as cover_image_id',
                'cover_image.mfile_id as cover_detail_image_id'
            )
            ->join('page_details', function($join)use($mediapress){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '!=', '')
                    ->where('page_details.name', '!=', NULL)
                    ->where('page_details.deleted_at', NULL)
                    ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('page_details.language_id', $mediapress->activeLanguage->id);
            })
            ->join('urls', function($join){
                $join->on('urls.model_id', '=', 'page_details.id')->where('type', 'original')->where('urls.model_type', '!=', 'Mediapress\Modules\Content\Models\CategoryDetail');
            })
            ->leftJoin('mfile_general as interior_image', function($join){
                $join->on('interior_image.model_id', '=', 'pages.id')
                    ->where('interior_image.file_key', 'interior')
                    ->where('interior_image.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->leftJoin('mfile_general as cover_image', function($join){
                $join->on('cover_image.model_id', '=', 'pages.id')
                    ->where('cover_image.file_key', 'cover')
                    ->where('cover_image.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->leftJoin('mfile_general as cover_detail_image', function($join){
                $join->on('cover_detail_image.model_id', '=', 'page_details.id')
                    ->where('cover_detail_image.file_key', 'cover')
                    ->where('cover_detail_image.model_type', 'Mediapress\Modules\Content\Models\PageDetail');
            })
            ->where(function($q)use($searchQuery){
                return $q->where('page_details.name', 'like', '%'.$searchQuery.'%')
                    ->orWhere('page_details.detail', 'like', '%'.$searchQuery.'%')
                    ->orWhere('page_details.search_text', 'like', '%'.$searchQuery.'%')
                    ->orWhere('pages.cint_3', $searchQuery);
            })
            ->whereIn('pages.sitemap_id', $sitemaps)
            ->get();

        $sitemaps_records = \DB::table('sitemaps')
            ->select(
                'sitemaps.id',
                'sitemap_details.id as sitemap_detail_id',
                'sitemap_details.name as title',
                'sitemap_details.detail as description',
                'urls.url as detail_url'
            )
            ->join('sitemap_details', function($join)use($mediapress){
                $join->on('sitemap_details.sitemap_id', '=', 'sitemaps.id')
                    ->where('sitemap_details.name', '<>', '')
                    ->where('sitemap_details.name', '!=', NULL)
                    ->where('sitemap_details.deleted_at', NULL)
                    ->where('sitemap_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('sitemap_details.language_id', $mediapress->activeLanguage->id);
            })
            ->join('urls', function($join){
                $join->on('urls.model_id', '=', 'sitemap_details.id')->where('type', 'original')->where('urls.model_type', 'Mediapress\Modules\Content\Models\SitemapDetail');
            })
            ->where(function($q)use($searchQuery){
                return $q->where('sitemap_details.name', 'like', '%'.$searchQuery.'%')
                    ->orWhere('sitemap_details.search_text', 'like', '%'.$searchQuery.'%')
                    ->orWhere('sitemap_details.detail', 'like', '%'.$searchQuery.'%');
            })
            ->whereIn('sitemaps.id', $sitemaps)
            ->get();

        $categories = \DB::table('categories')
            ->select(
                'categories.id',
                'category_details.id as category_details_id',
                'category_details.name as title',
                'category_details.detail as description',
                'urls.url as detail_url'
            )
            ->join('category_details', function($join)use($mediapress){
                $join->on('category_details.category_id', '=', 'categories.id')
                    ->where('category_details.name', '!=', '-')
                    ->where('category_details.deleted_at', NULL)
                    ->where('category_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('category_details.language_id', $mediapress->activeLanguage->id);
            })
            ->join('urls', function($join){
                $join->on('urls.model_id', '=', 'category_details.id')->where('type', 'original')->where('urls.model_type', 'Mediapress\Modules\Content\Models\CategoryDetail');
            })
            ->where(function($q)use($searchQuery){
                return $q->where('category_details.name', 'like', '%'.$searchQuery.'%')
                    ->orWhere('category_details.detail', 'like', '%'.$searchQuery.'%');
            })
            ->where('categories.category_id', '!=', 0)
            ->whereIn('categories.sitemap_id', $sitemaps)
            ->get();

        $results = new Collection($categories->merge($product_pages));
        $results = $results->merge($pages);
        $results = $results->merge($sitemaps_records);
        $results = $results->paginate(9);
        return view('search.results', compact('results'));
	}
}
