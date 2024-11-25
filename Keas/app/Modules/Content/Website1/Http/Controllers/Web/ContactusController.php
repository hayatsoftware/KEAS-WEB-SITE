<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Heraldist\Models\Form;
use Mediapress\Modules\Heraldist\Traits\FormTrait;
use Illuminate\Support\Facades\Mail;
use Mediapress\Modules\MPCore\Models\Country;

class ContactusController extends BaseController
{
    use FormTrait;

    public function SitemapDetail(Mediapress $mediapress) {

        $mediapress->data['countries'] = get_countries();
        $mediapress->data['subjects'] = Page::where('sitemap_id', CRM_SUBJECT_ST_ID)->where('status', 1)->orderBy('order')->get();
        $mediapress->data['offices'] = self::getOffices(CONTACT_OFFICES_ST_ID, $mediapress);
        $mediapress->data['domestic_offices'] = self::getOffices(CONTACT_DOMESTIC_OFFICES_ST_ID, $mediapress);
        $mediapress->data['abroad_offices'] = self::getOffices(CONTACT_ABROAD_OFFICES_ST_ID, $mediapress);
        $form = Form::find(1);
        $formVariables = $form ? $this->getFormVariables($form) : [];
        $mediapress->data['formVariables'] = $formVariables;
        $ua = new \Mediapress\Foundation\UserAgent\UserAgent();
        $device = $ua->getDevice();
        $mediapress->data['device'] = $device;
		return $this->sitemapDetailFunc([
		]);
	}

    private function getOffices($sitemap_id, $mediapress)
    {
        return Cache::remember('office_data_'.$mediapress->activeCountryGroup->code.'_'.$mediapress->activeLanguage->code.'_'.$sitemap_id, 7*24*60*60, function()use($mediapress, $sitemap_id){
            return Page::where('sitemap_id', $sitemap_id)
                ->whereHas('details', function($query)use($mediapress){
                    return $query->where('language_id', $mediapress->activeLanguage->id)
                        ->where('country_group_id', $mediapress->activeCountryGroup->id)
                        ->whereNull('deleted_at')
                        ->where(function($q){
                            return $q->where('name', '!=', '');
                        });
                })
                ->where('status', 1)
                ->orderBy('order')
                ->get();
        });

    }

    public function postForm($form, $request)
    {

        $rules = [
            'name'      => 'required',
            'surname'   => 'required',
            'phone'     => 'required',
            'email'      => 'required|email:rfc,dns',
            'country'   => 'required',
            'city'   => 'required',
            'subject'   => 'required',
            'kvkk'   => 'required',
            'source' => 'required',
            'g-recaptcha-response' => 'required|recaptcha',
            'message' => 'max:1000'

        ];

        $message = [
            'email.email'     => langPartAttr('contact.email.email', 'Please type a valid e-mail'),
            'g-recaptcha-response.required' => langPartAttr('contact.form.g_recaptcha_response', 'Please validate recaptcha.'),
            'message.max' => langPartAttr('contact.form.message.max', 'You can use max 1000 characters.'),
        ];

        $fields = [
            'contact.form.name'      => langPart('contact.form.name', 'Name'),
            'contact.form.surname'   => langPart('contact.form.surname', 'Surname'),
            'contact.form.phone'    => langPart('contact.form.phone', 'Telefon'),
            'contact.form.email'  => langPart('contact.form.email', 'E-mail'),
            'contact.form.country'  => langPart('contact.form.country', 'Country'),
            'contact.form.city'  => langPart('contact.form.city', 'City'),
            'contact.form.subject'  => langPart('contact.form.subject', 'Subject'),
            'contact.form.message'  => langPart('contact.form.message', 'Message'),
            'contact.form.contact_text'  => langPart('contact.form.contact_text', 'Contact Sms-Email Permission'),
            'contact.form.kvkk'  => langPart('contact.form.kvkk', 'KVKK Permission'),
        ];



        $this->validate($request, $rules, $message, $fields);

        $data = $request->all();
        $data["website"] = $form->websites->first()->slug;

        return $this->sendForm($form, $request, $data);
    }



}
