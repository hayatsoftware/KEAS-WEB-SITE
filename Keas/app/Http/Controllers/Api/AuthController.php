<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\SendActivationCode;
use App\PasswordResetCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Entity\Models\User;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\Language;
use PhpOffice\PhpWord\Media;

class AuthController extends Controller
{
    public function Login(Request $request): array
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $error_data = [];
        if ($validator->fails()) {
            $errors = $validator->errors()->messages();
            foreach($errors as $key => $error){
                if( $key == 'email' ){
                    $error_data[] = 'REQUIRE_EMAIL';
                }
                if( $key == 'password' ){
                    $error_data[] = 'REQUIRE_PASSWORD';
                }
            }
            return [
                'status' => 0,
                'type' => 'VALIDATION_ERRORS',
                'errors' => $error_data
            ];
        }
        $credentials = $request->only('email', 'password');
        if( !Auth::attempt($credentials) ){
            return [
                'status' => 0,
                'type' => 'NOT_VALID_USER'
            ];
        }
        $user = Auth::user();
        $accessToken = $user->createToken('authToken')->accessToken;

        return [
            'access_token' => $accessToken,
            'status' => 1
        ];
    }

    public function activation(Request $request):array
    {
        $code = $request->input('code');
        $user = $request->user();
        if( $user->code == $code ){
            $user->code = null;
            $user->status = 1;
            $user->save();
            return [
                'status' => 1
            ];
        }else{
            return [
                'status' => 0,
                'type' => 'NOT_VALID_CODE'
            ];
        }
    }

    public function reSendVerificationCode(Mediapress $mediapress,Request $request):array
    {

        $language_code = $request->input('language');
        $zone = $request->input('zone');
        $language = Language::where('code', $language_code)->first();
        $country_group = CountryGroup::where('code', $zone)->first();
        $mediapress->activeLanguage = Language::find($language->id);
        $mediapress->activeCountryGroup = CountryGroup::find($country_group->id);
        $user = $request->user();
        $user->code = rand(1000, 9999);
        $user->save();
        $email_data = [
            'line_one' => strip_tags(LangPart('dear_first_last_name', 'Dear :first_name :last_name', ['first_name'=>$user->first_name,'last_name'=>$user->last_name])),
            'line_two' => strip_tags(LangPart('your_verification_code_is_below', 'Your verification code is below. Please verify your account in order to access club advantages')),
            'subject' => strip_tags(LangPart('activation_subject', 'Please verify your account')),
            'code' => $user->code
        ];
        try {
            \Mail::to($user->email)->send(new SendActivationCode($email_data));
        } catch (\Exception $e) {
            return [
                'status' => 0
            ];
        }
        return [
            'status' => 1,
        ];
    }

    public function register(Mediapress $mediapress,Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'unique:users,email', 'email:rfc,dns'],
            'phone' => ['required'],
            'job' => ['required'],
            'products' => ['required'],
            'country' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation'=> ['required'],
            'is_kvkk' => ['accepted']
        ],
        [
            'first_name.required' => 'FIRST_NAME_REQUIRED_ERROR',
            'last_name.required' => 'LAST_NAME_REQUIRED_ERROR',
            'email.required' => 'EMAIL_REQUIRED_ERROR',
            'email.unique' => 'EMAIL_MUST_UNIQUE_ERROR',
            'email.email' => 'EMAIL_VALID_ERROR',
            'phone.required' => 'PHONE_REQUIRED_ERROR',
            'job.required' => 'JOB_REQUIRED_ERROR',
            'products.required' => 'PRODUCTS_REQUIRED_ERROR',
            'country.required' => 'COUNTRY_REQUIRED_ERROR',
            'password.required' => 'PASSWORD_REQUIRED_ERROR',
            'password.min' => 'PASSWORD_MIN_LENGTH_ERROR',
            'password_confirmation.required' => 'PASSWORD_CONFIRMATION_REQUIRED_ERROR',
            'password.confirmed' => 'PASSWORD_CONFIRM_REQUIRED_ERROR',
            'is_kvkk.accepted' => 'KVKK_ACCEPTED_ERROR',
        ]);
        $error_data = [];
        if ($validator->fails()) {
            $errors = $validator->errors()->messages();
            foreach($errors as $key => $error){
                $error_data[] = $error[0];
            }
            return [
                'status' => 0,
                'type' => 'VALIDATION_ERRORS',
                'errors' => $error_data
            ];
        }

        $data = $request->input();

        $user_data = [
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'password_text' => $data['password'],
            'code' => rand(1000, 9999),
            'phone' => $data['phone'] ?? null,
            'ip' => $data['ip'] ?? "",
            'user_agent' => $data['userAgent'] ?? "",
            'is_kvkk' => 1,
            'is_sms' => $data['is_contact_text'] ? 1 : 0,
            'is_email' => $data['is_contact_text'] ? 1 : 0,
            'data' => [
                'job' => $data['job'],
                'products' => $data['products'] ?? [],
                'country' => $data['country'] ?? null,
                'city' => $data['city'] ?? null,
                'zip_code' => $data['zip_code'] ?? null,
                'address' => $data['address'] ?? null,
                'source' => 'mobile',
                'phone_country' => $data['phone_country'] ?? 'TR',
                'phone_original' => $data['phone_original']
            ]
        ];

        $user = \App\User::create($user_data);

        $language_code = $request->input('language');
        $zone = $request->input('zone');
        $language = Language::where('code', $language_code)->first();
        $country_group = CountryGroup::where('code', $zone)->first();
        $mediapress->activeLanguage = Language::find($language->id);
        $mediapress->activeCountryGroup = CountryGroup::find($country_group->id);

        if( $user ){
            $email_data = [
                'line_one' => strip_tags(LangPart('dear_first_last_name', 'Dear :first_name :last_name', ['first_name'=>$user->first_name,'last_name'=>$user->last_name])),
                'line_two' => strip_tags(LangPart('your_verification_code_is_below', 'Your verification code is below. Please verify your account in order to access club advantages')),
                'subject' => strip_tags(LangPart('activation_subject', 'Please verify your account')),
                'code' => $user->code
            ];
            try {
                \Mail::to($user->email)->send(new SendActivationCode($email_data));
            } catch (Exception $e) {
                Log::error('smtp_error', ['error'=>$e]);
            }
        }

        Auth::login($user);
        $user = Auth::user();
        $accessToken = $user->createToken('authToken')->accessToken;
        return [
            'status' => 1,
            'access_token' => $accessToken
        ];
    }

    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user.first_name' => ['required'],
            'user.last_name' => ['required'],
            'user.email' => ['required'],
            'user.phone' => ['required'],
            'user.data.job' => ['required'],
            'user.data.products' => ['required'],
            'user.data.country' => ['required']
        ]);
        $error_data = [];
        if ($validator->fails()) {
            $errors = $validator->errors()->messages();
            foreach($errors as $key => $error){
                if( $key == 'user.first_name' ){
                    $error_data[] = 'FIRST_NAME_REQUIRED_ERROR';
                }
                if( $key == 'user.last_name' ){
                    $error_data[] = 'LAST_NAME_REQUIRED_ERROR';
                }
                if( $key == 'user.email' ){
                    $error_data[] = 'EMAIL_REQUIRED_ERROR';
                }
                if( $key == 'user.phone' ){
                    $error_data[] = 'PHONE_REQUIRED_ERROR';
                }
                if( $key == 'user.data.job' ){
                    $error_data[] = 'JOB_REQUIRED_ERROR';
                }
                if( $key == 'user.data.products' ){
                    $error_data[] = 'PRODUCTS_REQUIRED_ERROR';
                }
                if( $key == 'user.data.country' ){
                    $error_data[] = 'COUNTRY_REQUIRED_ERROR';
                }
                if( $key == 'user.data.zip_code' ){
                    $error_data[] = 'ZIP_CODE_REQUIRED_ERROR';
                }
            }
            return [
                'status' => 0,
                'type' => 'VALIDATION_ERRORS',
                'errors' => $error_data
            ];
        }
        $data = $request->input();
        $user_data = [
            'name' => $data['user']['first_name'] . ' ' . $data['user']['last_name'],
            'first_name' => $data['user']['first_name'],
            'last_name' => $data['user']['last_name'],
            'email' => $data['user']['email'],
            //'password' => $data['user']['password'] ? Hash::make($data['password']),
            //'password_text' => $data['password'],
            'phone' => $data['user']['phone'] ?? null,
            'is_kvkk' => 1,
            'is_sms' => $data['is_contact_permission'] ? 1 : 0,
            'is_email' => $data['is_contact_permission'] ? 1 : 0,
            'data' => [
                'job' => $data['user']['data']['job'] ?? null,
                'products' => $data['user']['data']['products'] ?? [],
                'country' => $data['user']['data']['country'] ?? null,
                'city' => $data['user']['data']['city'] ?? null,
                'zip_code' => $data['user']['data']['zip_code'] ?? null,
                'address' => $data['user']['data']['address'] ?? null,
                'source' => 'mobile',
                'phone_country' => $data['user']['data']['phone_country'] ?? 'TR',
                'phone_original' => $data['user']['data']['phone_original'],
                'dial_code' => $data['user']['data']['dial_code'] ?? '90'
            ],
            'is_crm' => 0
        ];
        if($data['password'] && !empty($data['password'])){
            $user_data['password'] = Hash::make($data['password']);
        }

        User::where('id', Auth()->user()->id)->update($user_data);
        return [
            'status' => 1
        ];
    }

    public function requestPassword(Mediapress $mediapress, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'email:rfc,dns']
        ],
            [
                'email.required' => 'EMAIL_REQUIRED_ERROR',
                'email.email' => 'EMAIL_VALID_ERROR',
            ]);
        $error_data = [];
        if ($validator->fails()) {
            $errors = $validator->errors()->messages();
            foreach($errors as $key => $error){
                $error_data[] = $error[0];
            }
            return [
                'status' => 0,
                'type' => 'VALIDATION_ERRORS',
                'errors' => $error_data
            ];
        }
        $email = $request->input('email');
        $check_email = User::where('email', $email)->first();
        if(!$check_email){
            return [
                'status' => 0,
                'errors' => ['NOT_VALID_USER_EMAIL']
            ];
        }
        $language_code = $request->input('language');
        $zone = $request->input('zone');
        $language = Language::where('code', $language_code)->first();
        $country_group = CountryGroup::where('code', $zone)->first();
        $mediapress->activeLanguage = Language::find($language->id);
        $mediapress->activeCountryGroup = CountryGroup::find($country_group->id);
        $code = rand(1000, 9999);
        PasswordResetCode::create([
            'email' => $email,
            'code' => $code
        ]);
        $email_data = [
            'line_one' => strip_tags(LangPart('dear_first_last_name', 'Syn. :first_name :last_name', ['first_name'=>$check_email->first_name,'last_name'=>$check_email->last_name])),
            'line_two' => strip_tags(LangPart('your_verification_code_is_below_password', 'Şifrenizi yenilemeniz için ihtiyaç duyduğunuz aktivasyon kodu aşağıdadır.')),
            'subject' => strip_tags(LangPart('reset_password_app', 'Şifrenizi Yenileyin')),
            'code' => $code
        ];
        try {
            \Mail::to($email)->send(new SendActivationCode($email_data));
        } catch (\Exception $e) {
            return [
                'status' => 0
            ];
        }
        return [
            'status' => 1,
        ];
    }

    public function reSendPasswordResetCode(Mediapress $mediapress,Request $request):array
    {

        $language_code = $request->input('language');
        $zone = $request->input('zone');
        $language = Language::where('code', $language_code)->first();
        $country_group = CountryGroup::where('code', $zone)->first();
        $mediapress->activeLanguage = Language::find($language->id);
        $mediapress->activeCountryGroup = CountryGroup::find($country_group->id);
        $code = rand(1000, 9999);
        $email = $request->input('email');
        $user = \App\User::where('email', $email)->first();
        PasswordResetCode::create([
            'email' => $email,
            'code' => $code
        ]);
        $email_data = [
            'line_one' => strip_tags(LangPart('dear_first_last_name', 'Syn. :first_name :last_name', ['first_name'=>$user->first_name,'last_name'=>$user->last_name])),
            'line_two' => strip_tags(LangPart('your_verification_code_is_below_password', 'Şifrenizi yenilemeniz için ihtiyaç duyduğunuz aktivasyon kodu aşağıdadır.')),
            'subject' => strip_tags(LangPart('reset_password_app', 'Şifrenizi Yenileyin')),
            'code' => $code
        ];
        try {
            \Mail::to($email)->send(new SendActivationCode($email_data));
        } catch (\Exception $e) {
            return [
                'status' => 0
            ];
        }
        return [
            'status' => 1,
        ];
    }

    public function validatePasswordCode(Request $request)
    {
        $email = $request->input('email');
        $code = $request->input('code');
        $passwordCode = PasswordResetCode::where('email', $email)->orderBy('created_at', 'DESC')->first();
        if( $passwordCode->code == $code ){
            return [
                'status' => 1
            ];
        }else{
            return [
                'status' => 0
            ];
        }
    }

    public function resetPassword(Request $request): array
    {
        $validator = Validator::make($request->all(),[
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation'=> ['required'],
                'email' => 'required',
                'code' => 'required'
            ],
            [
                'password.required' => 'PASSWORD_REQUIRED_ERROR',
                'password.min' => 'PASSWORD_MIN_LENGTH_ERROR',
                'password_confirmation.required' => 'PASSWORD_CONFIRMATION_REQUIRED_ERROR',
                'password.confirmed' => 'PASSWORD_CONFIRM_REQUIRED_ERROR',
            ]);
        $error_data = [];
        if ($validator->fails()) {
            $errors = $validator->errors()->messages();
            foreach($errors as $key => $error){
                $error_data[] = $error[0];
            }
            return [
                'status' => 0,
                'type' => 'VALIDATION_ERRORS',
                'errors' => $error_data
            ];
        }

        $email = $request->input('email');
        $code = $request->input('code');
        $passwordCode = PasswordResetCode::where('email', $email)->orderBy('created_at', 'DESC')->first();
        if( !$passwordCode || $passwordCode->code != $code ){
            return [
                'status' => 1,
                'msg' => 'AN_ERROR_OCCURED'
            ];
        }
        $password = $request->input('password');
        $user = \App\User::where('email', $email)->first();
        $user->password = Hash::make($password);
        $user->save();
        return [
            'status' => 1
        ];

    }

}
