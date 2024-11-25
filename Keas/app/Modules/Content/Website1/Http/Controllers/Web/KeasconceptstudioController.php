<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;

class KeasconceptstudioController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {

        $mediapress->data['events'] = Page::where('sitemap_id', BLOG_ST_ID)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->whereNull('deleted_at')
                    ->where(function($q){
                        return $q->where('name', '!=', '');
                    });
            })
            ->whereHas('categories', function($query){
                return $query->where('id', 127);
            })
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

		return $this->sitemapDetailFunc([
		]);
	}






}
