<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;

class CorporateidentityController extends BaseController
{

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
            ->orderBy('order')
            ->where('status', 1)
            ->get();
		return view('web.pages.corporateidentity.sitemap', compact('mediapress'));
	}



}
