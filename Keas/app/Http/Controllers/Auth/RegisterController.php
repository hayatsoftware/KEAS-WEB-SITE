<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendActivationCode;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,
            [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'job' => ['required'],
                'phone' => ['required'],
                'products' => ['required'],
                'country' => ['required'],
                'city' => ['required'],
                'g-recaptcha-response' => 'required|recaptcha',
                'kvkk' => 'accepted'
            ],
            [
                'g-recaptcha-response.required' => langPartAttr('contact.form.g_recaptcha_response', 'Please validate recaptcha.'),
                'kvkk.accepted' => strip_tags(langPart('subscription.kvkk.accepted', 'Please accept kvkk field in order to send your request.')),
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $phone_data = explode(' ',$data['phone']);
        unset($phone_data[0]);
        $org_phone = implode(' ', $phone_data);
        $user_data = [
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'password_text' => $data['password'],
            'code' => rand(1000, 9999),
            'phone' => $data['phone'] ?? null,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'is_kvkk' => 1,
            'is_sms' => isset($data['contact_text']) && $data['contact_text'] == 1 ? 1 : 0,
            'is_email' => isset($data['contact_text']) && $data['contact_text'] == 1 ? 1 : 0,
            'data' => [
                'job' => $data['job'] ?? null,
                'products' => $data['products'] ?? [],
                'country' => $data['country'] ?? null,
                'city' => $data['city'] ?? null,
                'zip_code' => $data['zip_code'] ?? null,
                'address' => $data['address'] ?? null,
                'source' => $data['source'],
                'phone_country' => $data['phone_country'] ?? 'TR',
                'phone_original' => $org_phone
            ]
        ];

        $user = User::create($user_data);
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
        return $user;
    }


    public function redirectPath()
    {

        $next = request()->get('next');

        if (!$next) {
            $next = url();
        }
        return $next;
    }
}
