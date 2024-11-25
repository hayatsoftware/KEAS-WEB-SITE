<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Entity\Models\User;

class UpdatepasswordController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress, Request $request) {

        if( $request->token ){
            $token = DB::table('password_resets')->where('token', $request->token)->first();
            if (!$token) abort(404);
            $user = User::where('email', $token->email)->first();
            if (!$user) abort(404);
            $sitemap = $mediapress->sitemap;
            $mediapress->data['sitemap'] = $sitemap;
            return view('web.pages.updatepassword.sitemap', compact('mediapress'));
        }else{
            abort(404);
        }

		return $this->sitemapDetailFunc([
		]);
	}


    public function ResetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        $token_data = DB::table('password_resets')->where('token', $request->token)->first();
        if (!$token_data) return redirect()->back()->with(["error" => LangPart('system_error', 'Bir hata meydana geldi. Lütfen yönetici ile iletişime geçiniz.') ]);

        $password = $request->input('password');
        $update_data = [
            'password' => Hash::make($password)
        ];
        $user = User::where('email', $token_data->email)->update($update_data);
        DB::table('password_resets')->where('email', $token_data->email)->delete();
        \Session::flash('reset_password_success', "reset_password_success");
        return redirect($request->get('next'));
    }



}
