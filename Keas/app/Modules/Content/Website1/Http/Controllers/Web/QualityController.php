<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;

class QualityController extends BaseController
{



    public function PageDetail(Mediapress $mediapress) {
        $mediapress->data['pages'] = Page::where('sitemap_id', QUALITY_SUB_PAGE_ST_ID)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('country_group_id', $mediapress->activeCountryGroup->id)->where('language_id', $mediapress->activeLanguage->id);
            })
            ->where('status', 1)
            ->where('page_id', $mediapress->parent->id)
            ->orderBy('order')
            ->get();
		return $this->pageDetailFunc([
            "page" => [
                "select" => ["*"],
                "image" => ["cover"],
            ],
		]);
	}




}
