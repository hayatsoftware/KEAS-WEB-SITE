<?php

namespace App\Http\Controllers;

use App\CrmCatalogue;
use App\CrmInfo;
use App\CrmSubscriptions;
use App\Foundation\Crm\CatalogueRequest;
use App\Foundation\Crm\Subscription;
use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\Language;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendActivationCode;

class WebServiceController extends Controller
{
    use ThrottlesLogins;

    protected $maxAttempts = 5;
    protected $decaySeconds = 60;


    public function fixExtras()
    {
        $detail_extras = \DB::table('page_detail_extras')
            ->where('key', 'quantity')
            ->orWhere('key', 'summary')
            ->orWhere('key', 'summary_two')
            ->orWhere('key', 'summary_three')
            ->orWhere('key', 'usage_area')
            ->orWhere('key', 'threedparams')
            ->orWhere('key', 'button_text')
            ->orWhere('key', 'button_url')
            ->orWhere('key', 'file_embed')
            ->groupBy('page_detail_id', 'key')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach($detail_extras as $extra){
            \DB::table('page_detail_extras')->where('id', $extra->id)->delete();
        }
        echo 'done';
    }
    public function getLanguagesOfSelectedZone(Request $request): JsonResponse
    {
        $language_data = [];
        if( $request->input('country_group') ){
            $country_slug = $request->input('country_group');
            $country = \DB::table('countries')->where('id', $country_slug)->first();
            $country_group_country = \DB::table('country_group_country')->where('country_code', $country->code)->first();
            if( $country_group_country ){
                $languages = \DB::table('country_group_language')->where('country_group_id', $country_group_country->country_group_id)->get();
            }else{
                $languages = \DB::table('country_group_language')->where('country_group_id', 1)->get();
            }
            foreach( $languages as $language ){
                $language_item = \DB::table('languages')->where('id', $language->language_id)->first();
                $language_data[] = [
                    'slug' => $language_item->id,
                    'name' => strip_tags(LangPart(\Str::slug($language_item->name, '-'), $language_item->name))
                ];
            }

        }
        $language_data = collect($language_data)->sortBy('name')->values();
        return response()->json($language_data);
    }

    public function setCountryGroupAndLanguage(Request $request, Mediapress $mediapress): JsonResponse
    {
        $language = $request->input('language');
        $country_group = $request->input('country_group');
        $country = $request->input('country');
        $mediapress->activeLanguage = Language::find($language);
        $mediapress->activeCountryGroup = CountryGroup::find($country_group);
        $url = getUrlBySitemapId(1);
        session(['selected_country_code' => $country]);
        return response()->json([
            'status' => 1,
            'url' => $url
        ]);
    }

    public function resendActivationCode(Request $request, Mediapress $mediapress): JsonResponse
    {
        $user = User::find($request->input('user_id'));
        $language = $request->input('language_id');
        $country_group = $request->input('country_group_id');
        $mediapress->activeLanguage = Language::find($language);
        $mediapress->activeCountryGroup = CountryGroup::find($country_group);
        if( $user ){
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
                Log::error('smtp_error', ['error'=>$e]);
            }
            return response()->json([
                'status' => 1,
                'msg' => strip_tags(LangPart('we_have_sent_email', 'We have sent your new verification code your inbox.'))
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'msg' => strip_tags(LangPart('activation_resend_error', 'There is a error occurred. Please contact with administration'))
            ]);
        }

    }

    public function updateProfile(Request $request)
    {
        $request->validate(
            [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'job' => ['required'],
                'country' => ['required'],
                'city' => ['required']
            ]
        );
        $data = $request->input();
        $phone_data = explode(' ',$data['phone']);
        unset($phone_data[0]);
        $org_phone = implode(' ', $phone_data);
        $user_data = [
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'] ?? null,
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
                'phone_country' => $data['phone_country'] ?? 'TR',
                'phone_original' => $org_phone
            ],
            'is_crm' => 0
        ];

        if( $request->input('password') ){
            $request->validate(
                [
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]
            );
            $user_data['password'] = Hash::make($request->input('password'));
        }
        User::where('id', auth()->user()->id)->update($user_data);
        $next = $request->input('next');
        \Session::flash('success', "success");
        return redirect($next);
    }

    public function Subscription(Mediapress $mediapress, Request $request)
    {
        $cg = $request->input('cg');
        $lg = $request->input('lg');
        $mediapress->activeLanguage = Language::find($lg);
        $mediapress->activeCountryGroup = CountryGroup::find($cg);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $seconds = $this->limiter()->availableIn(
                $this->throttleKey($request)
            );
            $return_data = [
                'status' => false,
                'msg' => strip_tags(LangPart('too_many_subscription_attempts_error','Too many subscription requests. Please try again :second seconds later', ['second'=>$seconds]))
            ];
            return response()->json($return_data);
            exit;
        }
        $this->incrementSubscriptionAttempts($request);
        $request->validate(
            [
                'email' => 'email:rfc,dns|required',
                'brands' => 'required',
                'kvkk' => 'accepted'
            ],
            [
                'email.required' => strip_tags(langPart('subscription.email.required', 'E-mail field is required')),
                'email.email' => strip_tags(langPart('subscription.email.email', 'Please type a valid email')),
                'brands.required' => strip_tags(langPart('subscription.brands.required', 'Please select at least one or more brand')),
                'kvkk.accepted' => strip_tags(langPart('subscription.kvkk.accepted', 'Please accept kvkk field in order to send your request.')),
            ]
        );


        $subscription = CrmSubscriptions::where('email', $request->input('email'))->first();
        if( $subscription ){
            $return_data = [
                'status' => false,
                'msg' => strip_tags(LangPart('crm.subscription.not.unique', 'Belirtilen e-posta adresine ait abonelik zaten bulunmaktadır.'))
            ];
        }else{
            CrmSubscriptions::create([
                'country_group_id' => $request->input('cg'),
                'language_id' => $request->input('lg'),
                'email' => $request->input('email'),
                'products' => $request->input('brands'),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'source' => $request->input('source') == 'mobile' ? 0 : 2
            ]);
            $return_data = [
                'status' => true
            ];
        }


        return response()->json($return_data);
    }

    public function SendCatalogue(Mediapress $mediapress, Request $request){
        $cg = $request->input('cg');
        $lg = $request->input('lg');
        $mediapress->activeLanguage = Language::find($lg);
        $mediapress->activeCountryGroup = CountryGroup::find($cg);

        $request->validate(
            [
                'catalogues' => 'required'
            ],
            [
                'catalogues.required' => strip_tags(langPart('catalogue.request.catalogues.required', 'Please select at least one catalogue'))
            ]
        );
        $check_catalogue = CrmCatalogue::where('user_id', auth()->user()->id)->whereDate('created_at', \Carbon\Carbon::today())->get();
        if($check_catalogue->isNotEmpty()){
            return redirect()->back()->withErrors(['already_exist_catalogue' => strip_tags(LangPart('already_exist_catalogue', 'You have already sent a catalogue request today.'))]);
        }
        CrmCatalogue::create([
            'user_id' => auth()->user()->id,
            'country_group_id' => $request->input('cg'),
            'language_id' => $request->input('lg'),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'catalogues' => $request->input('catalogues'),
            'source' => $request->input('source')  == 'mobile' ? 0 : 2
        ]);

        return redirect()->back()->with('success', strip_tags(LangPart('catalogue_request_success', 'Katalog talebi başarılı şekilde gönderildi.')));
    }

    public function getCategoryInfo(Request $request){
        $category_ids = $request->input('category_id');
        $categories = Category::whereIn('id', $category_ids)->get();
        $category_data = [];
        foreach($categories as $category){
            $category_data['parents'][] = $category->category_id;
            $category_data['id'][] = $category->id;
        }
        return response()->json($category_data);
    }

    /**
     * Increment the login attempts for the user.
     *
     * @return void
     */
    protected function incrementSubscriptionAttempts($request)
    {
        $key = $this->throttleKey($request);

        $this->hit($key, $this->decaySeconds);
    }

    /**
     * Increment the counter for a given key for a given decay time.
     *
     * @param  string  $key
     * @param  int  $decaySeconds
     * @return int
     */
    public function hit($key, $decaySeconds = 60)
    {

        $key = $this->cleanRateLimiterKey($key);

        \Cache::put($key.':timer', $this->availableAt($this->decaySeconds), $this->decaySeconds);

        \Cache::put($key, (int) \Cache::get($key) + 1, $this->decaySeconds);

        $hits = \Cache::get($key);

        return $hits;
    }

    /**
     * Get the number of seconds until the "key" is accessible again.
     *
     * @param  string  $key
     * @return int
     */
    public function availableIn($key)
    {
        return \Cache::get($key.':timer') - $this->currentTime();
    }

    /**
     * Get the current system time as a UNIX timestamp.
     *
     * @return int
     */
    protected function currentTime()
    {
        return Carbon::now()->getTimestamp();
    }

    /**
     * Get the "available at" UNIX timestamp.
     *
     * @param  \DateTimeInterface|\DateInterval|int  $delay
     * @return int
     */
    protected function availableAt($delay = 0)
    {
        $delay = $this->parseDateInterval($delay);

        return $delay instanceof DateTimeInterface
            ? $delay->getTimestamp()
            : Carbon::now()->addRealSeconds($delay)->getTimestamp();
    }

    /**
     * If the given value is an interval, convert it to a DateTime instance.
     *
     * @param  \DateTimeInterface|\DateInterval|int  $delay
     * @return \DateTimeInterface|int
     */
    protected function parseDateInterval($delay)
    {
        if ($delay instanceof DateInterval) {
            $delay = Carbon::now()->add($delay);
        }

        return $delay;
    }

    /**
     * Clean the rate limiter key from unicode characters.
     *
     * @param  string  $key
     * @return string
     */
    public function cleanRateLimiterKey($key)
    {
        return preg_replace('/&([a-z])[a-z]+;/i', '$1', htmlentities($key));
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return 'subscription_'.$request->ip();
    }

}
