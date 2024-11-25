<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\Language;

class MyaccountController extends BaseController
{


    public function SitemapDetail(Mediapress $mediapress) {
        if( !auth()->check() ){
            return redirect(getUrlBySitemapId(LOGIN_ST_ID));
        }
        if( auth()->user()->status == 3 ){
            return redirect(getUrlBySitemapId(USER_ACTIVATION_ST_ID));
        }
        $mediapress->data['sitemap'] = $mediapress->parent;
        $user = auth()->user();
		return view('web.pages.myaccount.sitemap', compact('mediapress', 'user'));
	}


    public function logout($cg, $lg, Mediapress $mediapress)
    {
        $mediapress->activeLanguage = Language::where('code', $lg)->first();
        $mediapress->activeCountryGroup = CountryGroup::where('code', $cg)->first();
        Auth::guard('web')->logout();
        return redirect(getUrlBySitemapId(1));
    }



}
