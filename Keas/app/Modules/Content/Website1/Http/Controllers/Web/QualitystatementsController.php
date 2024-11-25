<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;

class QualitystatementsController extends BaseController
{



    public function PageDetail(Mediapress $mediapress) {

		return $this->pageDetailFunc([
            "page" => [
                "select" => ["*"],
                "image" => ["cover"],
            ],
            "category" => [
                "select" => ["id", "category_id", "status", "detail.id", "detail.category_id", "detail.name", "detail.detail", "url.url", "url.model_id", "url.model_type"],
                "image" => ["cover"],
            ],
		]);
	}

    public function CategoryDetail(Mediapress $mediapress) {

		return $this->categoryDetailFunc([
                "children" => [
                    "select" => ["id", "category_id", "status", "detail.id", "detail.category_id", "detail.name", "detail.detail", "url.url", "url.model_id", "url.model_type"],
                    "image" => ["cover"],
                ],
                "category" => [
                    "select" => ["id", "category_id", "status", "detail.id", "detail.category_id", "detail.name", "detail.detail", "url.url", "url.model_id", "url.model_type"],
                    "image" => ["cover"],
                ],
                "pages" => [
                    "select" => ["id", "status", "detail.id", "detail.page_id", "detail.name", "detail.detail", "url.url", "url.model_id", "url.model_type"],
                    "image" => ["cover"],
                    "paginate" => 12,
                    "order" => [
                        "by" => "order",
                        "direction" => "asc"
                    ]
                ],
		]);
	}


}
