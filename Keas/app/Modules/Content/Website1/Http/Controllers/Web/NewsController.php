<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;

class NewsController extends BaseController
{
    private const PER_PAGE = 10;

    public function SitemapDetail(Mediapress $mediapress) {

        $sitemap = $mediapress->parent;
        $mediapress->data['sitemap'] = $sitemap;
        $mediapress->data['pages'] = Page::where('sitemap_id', $sitemap->id)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->whereNull('deleted_at')
                    ->where(function($q){
                        return $q->where('name', '!=', '');
                    });
            })
            ->orderBy('cdat_1', 'DESC')
            ->where('status', 1)
            ->paginate(self::PER_PAGE);
        return view('web.pages.news.sitemap', compact('mediapress'));
	}

    public function PageDetail(Mediapress $mediapress) {
        $sitemap = $mediapress->sitemap;
        $page = $mediapress->parent;
        $mediapress->data['other'] = Page::where('sitemap_id', $sitemap->id)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->whereNull('deleted_at')
                    ->where(function($q){
                        return $q->where('name', '!=', '');
                    });
            })
            ->where('status', 1)
            ->where('id', '!=', $page->id)
            ->orderBy('created_at', 'DESC')
            ->take(3)
            ->get();
		return $this->pageDetailFunc([
            "page" => [
                "select" => ["*"],
                "image" => ["cover"],
            ],
		]);
	}




}
