<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;

class QualitypagesController extends BaseController
{

    public function PageDetail(Mediapress $mediapress) {
        $mediapress->data['sitemap'] = $mediapress->sitemap;
        $mediapress->data['page'] = $mediapress->parent;

        return view('web.pages.qualitypages.page', compact('mediapress'));
	}




}
