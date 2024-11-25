<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\Language;

class UseractivationController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {

		return $this->sitemapDetailFunc([
		]);
	}


    public function verifyUser(Mediapress $mediapress, Request $request)
    {
        $request->validate(
            [
                'code' => ['required', 'min:4', 'max:4']
            ],
            [
                'code.required' => strip_tags(LangPart('code_required', 'Please type a valid code')),
                'code.min' => strip_tags(LangPart('code_min', 'The code must be at least 4 characters.')),
                'code.max' => strip_tags(LangPart('code_max', 'The code may not be greater than 4 characters.')),
            ]
        );
        $code = $request->input('code');
        $user = auth()->user();
        if( $user->code == $code ){
            $user->code = NULL;
            $user->email_verified_at = \Carbon\Carbon::now();
            $user->status = 1;
            $user->save();
            $next = $request->input('next');
            \Session::flash('user_activation', strip_tags(LangPart('actiovation_success_message', 'You have successfully activated your account.')));
            return redirect($next);
        }else{
            return redirect()->back()->withErrors(['wrong_code'=>strip_tags(LangPart('code_is_not_valid', 'We couldnt verify your account. Please check your code and try again'))]);
        }
    }



}
