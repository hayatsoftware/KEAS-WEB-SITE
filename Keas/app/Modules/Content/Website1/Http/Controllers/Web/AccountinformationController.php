<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;

class AccountinformationController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {
        if( !auth()->check() ){
            return redirect(getUrlBySitemapId(LOGIN_ST_ID));
        }
        if( auth()->user()->status == 3 ){
            return redirect(getUrlBySitemapId(USER_ACTIVATION_ST_ID));
        }
        $mediapress->data['jobs'] = Page::where('sitemap_id', CRM_JOBS_ST_ID)->where('status',1)->orderBy('order')->get();
        $mediapress->data['products'] = \DB::table('categories')
            ->select(
                'categories.id',
                'categories.cint_1 as crm_id',
                'category_details.name',
            )
            ->join('category_details', function($join)use($mediapress){
                $join->on('category_details.category_id', '=', 'categories.id')
                    ->where('category_details.name', '!=', NULL)
                    ->where('category_details.language_id', $mediapress->activeLanguage->id)
                    ->where('category_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('category_details.deleted_at', NULL);
            })
            ->where('categories.sitemap_id', PRODUCT_ST_ID)
            ->whereIn('categories.category_id', [1,15])
            ->where('categories.status', 1)
            ->get();
        $mediapress->data['countries'] = get_countries();
        $mediapress->data['user'] = auth()->user();
		return $this->sitemapDetailFunc([
		]);
	}






}
