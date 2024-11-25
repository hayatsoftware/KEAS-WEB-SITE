<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Entity\Models\User;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\Language;

class ForgotmypasswordController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {

		return $this->sitemapDetailFunc([
		]);
	}


    public function validatePasswordReset(Request $request, Mediapress $mediapress){
        $mediapress->activeLanguage = Language::find($request->lg);
        $mediapress->activeCountryGroup = CountryGroup::find($request->cg);
        $user = User::where ('email', $request->email)->first();
        if ( !$user ) return redirect()->back()->with(['error' => LangPart('password.validate.error', 'Sisteme bu e-posta ile kayıtlı herhangi bir kullanıcı bulunamadı.')]);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => \Carbon\Carbon::now()
        ]);
        $token = DB::table('password_resets')->where('email', $request->email)->first();

        $email_data = [
            'email' => $request->email,
            'token' => $token->token,
            'url' => $request->next,
            'name' => $user->name,
            'title' => LangPart('reset_password', 'Şifre Yenileme'),
            'msg' => LangPart('reset_password_mail_message', 'Şifrenizi yenilemeniz için size bir bağlantı gönderdik.')
        ];


        try {
            Mail::send('vendor.mail.password_reset', $email_data, function ($message) use ($email_data) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->subject(strip_tags(LangPart('reset_password_mail', 'Reset Your Password')));
                $message->to($email_data['email']);
            });
        } catch (\Exception $e) {

        }

        return redirect()->back()->with(['success' => LangPart('password.validate.success', 'Şifrenizi yenilemeniz için size bir bağlantı gönderdik.')]);

    }



}
