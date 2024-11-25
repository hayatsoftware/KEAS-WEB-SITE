<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;

class InnovationController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {
		abort(404);
	}

    public function PageDetail(Mediapress $mediapress) {
        $page = $mediapress->parent;
        $mediapress->data['sitemap'] = $mediapress->sitemap;
        $mediapress->data['page'] = $page;
        return view('web.pages.innovation.page', compact('page', 'mediapress'));

    }




}
