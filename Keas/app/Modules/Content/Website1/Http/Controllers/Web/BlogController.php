<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\Page;

class BlogController extends BaseController
{

    private const PER_PAGE = 12;

    public function SitemapDetail(Mediapress $mediapress) {

        $mediapress->data['blog_pages'] = Page::where('sitemap_id', BLOG_ST_ID)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->whereNull('deleted_at')
                    ->where(function($q){
                        return $q->where('name', '!=', '');
                    });
            })
            ->whereHas('categories', function($query){
                return $query->where('id', '!=', 127);
            })
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(self::PER_PAGE);
        $mediapress->data['slider_pages'] = Page::where('sitemap_id', BLOG_ST_ID)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->whereNull('deleted_at')
                    ->where(function($q){
                        return $q->where('name', '!=', '');
                    });
            })
            ->where('status', 1)
            ->where('cint_1', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        $mediapress->data['categories'] = $mediapress->parent->categories();
		return $this->sitemapDetailFunc([
            "categories" => [
                "select" => ["id", "category_id", "status", "detail.id", "detail.category_id", "detail.name", "detail.detail", "url.url", "url.model_id", "url.model_type"],
                "image" => ["cover"],
            ],
		]);
	}

    public function PageDetail(Mediapress $mediapress) {

		return $this->pageDetailFunc([
            "page" => [
                "select" => ["*"],
                "image" => ["cover"],
            ],
            "category" => [
                "select" => ["id", "category_id", "status", "detail.id", "detail.category_id", "detail.name", "detail.detail", "url.url", "url.model_id", "url.model_type"],
                "image" => ["cover"],
            ],
		]);
	}

    public function CategoryDetail(Mediapress $mediapress) {
        $category = $mediapress->parent;

        $mediapress->data['sitemap'] = $mediapress->sitemap;
        $mediapress->data['category'] = $mediapress->parent;
        $mediapress->data['blog_pages'] = Page::where('sitemap_id', BLOG_ST_ID)
            ->where('status', 1)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->whereNull('deleted_at')
                    ->where(function($q){
                        return $q->where('name', '!=', '');
                    });
            })
            ->whereHas('categories', function($query)use($category){
                return $query->where('id', $category->id);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(self::PER_PAGE);
        $mediapress->data['slider_pages'] = Page::where('sitemap_id', BLOG_ST_ID)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->whereNull('deleted_at')
                    ->where(function($q){
                        return $q->where('name', '!=', '');
                    });
            })
            ->where('status', 1)
            ->where('cint_1', 1)
            ->orderBy('created_at', 'DESC')
            ->get();
        $mediapress->data['categories'] = Category::where('sitemap_id', BLOG_ST_ID)->where('status', 1)->orderBy('lft')->get();
		return view('web.pages.blog.category', compact('mediapress'));
	}

    private function getPages($mediapress, $category = null)
    {
        $pages_data = [];
        $pages = \DB::table('pages')
            ->select(
                'pages.id',
                'pages.cint_1',
                'page_details.id as page_detail_id',
                'page_details.name',
                'page_details.detail',
                'categories.id as category_id',
                'category_details.name as category_details_name',
                'urls.url',
                'cover_image.mfile_id as cover_image_id',
            )
            ->join('page_details', function($join)use($mediapress){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '!=', NULL)
                    ->where('page_details.language_id', $mediapress->activeLanguage->id)
                    ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->join('category_page', function($join){
                $join->on('category_page.page_id', '=', 'pages.id');
            })
            ->join('categories', function($join)use($category){
                $join->on('categories.id', '=' ,'category_page.category_id')
                ->when(!is_null($category), function($query)use($category){
                    return $query->where('categories.id', $category->id);
                });
            })
            ->join('category_details', function($join)use($mediapress){
                $join->on('category_details.category_id', '=', 'categories.id');
                $join->where('category_details.language_id', $mediapress->activeLanguage->id)
                    ->where('category_details.country_group_id', $mediapress->activeCountryGroup->id);
            })
            ->join('urls', function($join){
                $join->on('urls.model_id', '=', 'page_details.id')->where('urls.type', 'original')->where('urls.model_type', 'Mediapress\Modules\Content\Models\PageDetail');
            })
            ->leftJoin('mfile_general as cover_image', function($join){
                $join->on('cover_image.model_id', '=', 'pages.id')->where('cover_image.file_key', 'cover')->where('cover_image.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->where('pages.sitemap_id', BLOG_ST_ID)
            ->where('pages.status', 1)
            ->orderBy('pages.created_at', 'DESC')
            ->paginate(self::PER_PAGE);
        $pages_data['pages'] = [];
        foreach($pages->unique('category_id') as $page){
            $pages_data['pages'][] = [
                'id' => $page->id,
                'detail_id' => $page->page_detail_id,
                'image' => image(get_image($page->cover_image_id))->originalUrl,
                'name' => $page->name,
                'url' => $page->url,
                'detail' => strip_tags($page->detail)
            ];
        }
        $pages_data['pagination'] = $pages->links();
        return $pages_data;
    }

    private function getPagesManset($mediapress, $category = null)
    {
        $pages_data = [];
        $pages = \DB::table('pages')
            ->select(
                'pages.id',
                'pages.cint_1',
                'page_details.id as page_detail_id',
                'page_details.name',
                'page_details.detail',
                'categories.id as category_id',
                'category_details.name as category_details_name',
                'urls.url',
                'cover_image.mfile_id as cover_image_id',
            )
            ->join('page_details', function($join)use($mediapress){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '!=', NULL)
                    ->where('page_details.language_id', $mediapress->activeLanguage->id)
                    ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->join('category_page', function($join){
                $join->on('category_page.page_id', '=', 'pages.id');
            })
            ->join('categories', function($join)use($category){
                $join->on('categories.id', '=' ,'category_page.category_id')
                    ->when(!is_null($category), function($query)use($category){
                        return $query->where('categories.id', $category->id);
                    });
            })
            ->join('category_details', function($join)use($mediapress){
                $join->on('category_details.category_id', '=', 'categories.id');
                $join->where('category_details.language_id', $mediapress->activeLanguage->id)
                    ->where('category_details.country_group_id', $mediapress->activeCountryGroup->id);
            })
            ->join('urls', function($join){
                $join->on('urls.model_id', '=', 'page_details.id')->where('urls.type', 'original')->where('urls.model_type', 'Mediapress\Modules\Content\Models\PageDetail');
            })
            ->leftJoin('mfile_general as cover_image', function($join){
                $join->on('cover_image.model_id', '=', 'pages.id')->where('cover_image.file_key', 'cover')->where('cover_image.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->where('pages.sitemap_id', BLOG_ST_ID)
            ->where('pages.status', 1)
            ->orderBy('pages.created_at', 'DESC')
            ->get();
        $pages_data['pages'] = [];
        foreach($pages as $page){
            $pages_data['pages'][] = [
                'id' => $page->id,
                'detail_id' => $page->page_detail_id,
                'image' => image(get_image($page->cover_image_id))->originalUrl,
                'name' => $page->name,
                'url' => $page->url,
                'detail' => strip_tags($page->detail)
            ];
        }
        return $pages_data;
    }
}
