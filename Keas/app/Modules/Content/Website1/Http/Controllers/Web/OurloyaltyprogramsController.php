<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;

class OurloyaltyprogramsController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {

		abort(404);
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