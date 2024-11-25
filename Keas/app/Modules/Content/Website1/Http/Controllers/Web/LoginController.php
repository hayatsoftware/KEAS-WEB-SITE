<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;

class LoginController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {
        if( auth()->check() ){
            return redirect(getUrlBySitemapId(MY_ACCOUNT_ST_ID));
        }
		return $this->sitemapDetailFunc([
		]);
	}






}
