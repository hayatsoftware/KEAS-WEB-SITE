<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;

class YoudesignController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {
        $mediapress->data['sitemap'] = $mediapress->parent;
        $mediapress->data['pages'] = Page::where('sitemap_id', YOU_DESIGN_ST_ID)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->where(function($q){
                        return $q->where('name', '!=', '');
                    });
            })
            ->where('status', 1)
            ->orderBy('order')
            ->get();
		return view('web.pages.youdesign.sitemap', compact('mediapress'));
	}

    public function PageDetail(Mediapress $mediapress) {
        $mediapress->data['sitemap'] = $mediapress->sitemap;
        $mediapress->data['page'] = $mediapress->parent;
        $mediapress->data['sub_pages'] = Page::where('sitemap_id', YOU_DESIGN_SUB_PAGES_ST_ID)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->where(function($q){
                        return $q->where('name', '!=', '');
                    });
            })
            ->where('status', 1)
            ->where('page_id', $mediapress->parent->id)
            ->orderBy('order')
            ->get();
		return view('web.pages.youdesign.page', compact('mediapress'));
	}




}
