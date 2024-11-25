<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;

class RequestcatalogueController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {

        if( !auth()->check() ){
            return redirect(getUrlBySitemapId(LOGIN_ST_ID));
        }
        $ua = new \Mediapress\Foundation\UserAgent\UserAgent();
        $device = $ua->getDevice();
        $mediapress->data['catalogues'] = Page::where('sitemap_id', KEAS_CRM_CATALOGUE_ST_ID)
            ->where('status', 1)
            ->orderBy('order')
            ->get();
        $mediapress->data['device'] = $device;
		return $this->sitemapDetailFunc([
		]);
	}






}
