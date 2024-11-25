<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;

class ManagementsController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {



		return $this->sitemapDetailFunc([
            "categories" => [
                "select" => ["id", "category_id", "status", "detail.id", "detail.category_id", "detail.name", "detail.detail", "url.url", "url.model_id", "url.model_type"],
                "image" => ["cover"],
            ],
		]);
	}

    public function PageDetail(Mediapress $mediapress) {

        return redirect(getUrlBySitemapId(1));
	}

    public function CategoryDetail(Mediapress $mediapress) {

        return redirect(getUrlBySitemapId(1));
	}


}
