<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\MPCore\Models\Country;

class RegisterController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {

        if( auth()->check() ){
            return redirect(getUrlBySitemapId(MY_ACCOUNT_ST_ID));
        }
        $ua = new \Mediapress\Foundation\UserAgent\UserAgent();
        $device = $ua->getDevice();
        $mediapress->data['jobs'] = Page::where('sitemap_id', CRM_JOBS_ST_ID)->where('status',1)->orderBy('order')->get();
        $mediapress->data['products'] = \DB::table('pages')
            ->select(
                'pages.id',
                'pages.cint_1 as crm_id',
                'page_details.name',
            )
            ->join('page_details', function($join)use($mediapress){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '!=', NULL)
                    ->where('page_details.language_id', $mediapress->activeLanguage->id)
                    ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->where('pages.sitemap_id', CRM_PREFERRED_PRODUCTS_ST_ID)
            ->where('pages.status', 1)
            ->orderBy('pages.order')
            ->get();

        $mediapress->data['countries'] = get_countries();
        $mediapress->data['device'] = $device;

		return $this->sitemapDetailFunc([
		]);
	}






}
