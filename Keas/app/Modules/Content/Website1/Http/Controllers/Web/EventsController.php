<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;

class EventsController extends BaseController
{



    public function PageDetail(Mediapress $mediapress) {
        $mediapress->data['other_events'] = Page::where('sitemap_id', EVENTS_ST_ID)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->whereNull('deleted_at')
                    ->where(function($q){
                        return $q->where('name', '!=', '');
                    });
            })
            ->where('status', 1)
            ->orderBy('order')
            ->get()
            ->except([$mediapress->parent->id]);
		return $this->pageDetailFunc([
            "page" => [
                "select" => ["*"],
                "image" => ["cover"],
                "order" => [
                    "by" => "order",
                    "direction" => "asc"
                ]
            ],
		]);
	}




}
