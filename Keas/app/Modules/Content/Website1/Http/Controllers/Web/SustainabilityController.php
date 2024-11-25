<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;

class SustainabilityController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {
        $mediapress->data['sitemap'] = $mediapress->parent;
        $mediapress->data['pages'] = Page::whereSitemapId(SUSTAINABILITY_ST_ID)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('language_id', $mediapress->activeLanguage->id);
            })
            ->status(1)
            ->orderBy('order')
            ->get();
		return view('web.pages.sustainability.sitemap', compact('mediapress'));
	}

    public function PageDetail(Mediapress $mediapress) {

		return $this->pageDetailFunc([
            "page" => [
                "select" => ["*"],
                "image" => ["cover"],
            ],
		]);
	}




}
