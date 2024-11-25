<?php

namespace App\Console\Commands;

use App\CrmInfo;
use App\Foundation\Crm\ContactForm;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mediapress\Modules\MPCore\Models\Country;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\CountryGroupCountry;

class CrmContactForm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:contact-form';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing crm subscription request';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        CrmInfo::where('type', 'contact_form')->where('status', 0)->delete();
        $messages = \DB::table('messages')->where('form_id', 1)->where('is_crm', 0)->paginate(100);
        foreach($messages as $message){

            $crmApi = new ContactForm();
            $fields = json_decode($message->data, TRUE);
            foreach($fields as $field){
                if($field['key'] == '546001ebdc53680514dc259801e0dd92'){
                    $crmApi->setName($field['value']);
                }
                if($field['key'] == 'eb425f9eaee57344bd9922b9cf36c670'){
                    $crmApi->setSurname($field['value']);
                }
                if($field['key'] == '0bd46b283394104fea39f07ce413315d'){
                    $crmApi->setPhone($field['value']);
                }
                if($field['key'] == 'd427196a71908a5f7554a64fdc1fa32c'){
                    $crmApi->setEmail($field['value']);
                }
                if($field['key'] == 'c9e76398a3d4c2292894f76703055a15'){
                    if($field['value'] == 'Birlesik Arap Emirlikleri'){
                        $crmApi->setCountry('Birleşik Arap Emirlikleri');
                    }else if($field['value'] == 'Karadag'){
                        $crmApi->setCountry('Karadağ');
                    }else{
                        $crmApi->setCountry($field['value']);
                    }
                    $country = Country::where('tr', $field['value'])->first();
                    $not_list_array = ['Niue (Yeni Zelanda)', 'Clipperton Adası (Fransa)', 'Beyaz Rusya', 'Bosna-Hersek'];
                    if(in_array($field['value'], $not_list_array)){
                        $crmApi->setSelectedZone('Global');
                    }else{
                        if(!isset($country->code)){
                           Log::info('ülke bulunamadı:'. $field['value']);
                            $crmApi->setSelectedZone('Global');
                        }else{
                            $country_group_country = CountryGroupCountry::where('country_code', $country->code)->first();
                            if($country_group_country){
                                $country_group = CountryGroup::find($country_group_country->country_group_id);
                                $crmApi->setSelectedZone($country_group->list_title);
                            }else{
                                $crmApi->setSelectedZone('Global');
                            }
                        }
                    }
                }
                if($field['key'] == '00999f02bbe2dfe29c425d519b623de0'){
                    $crmApi->setCity($field['value']);
                }
                if($field['key'] == 'f5b731376263b21bb3a444c99a35bd08'){
                    $crmApi->setSubject(intval($field['value']));
                }
                if($field['key'] == 'ee0d5f5b21c6f8b55713f1e122594aa0'){
                    $crmApi->setMessage($field['value']);
                }
                if( $field['key'] == 'd7d7d1fcd7241eba195c68ffd1d6d57d' ){
                    $crmApi->setSmsPermission();
                    $crmApi->setEmailPermission();
                }
                if( $field['key'] == '3cf207ded83fd476c6ef1746080cb335' ){
                    if($field['value'] == 'mobile'){
                        $crmApi->setSource(0);
                    }else{
                        $crmApi->setSource(2);
                    }

                }
                if( $field['key'] == 'b3bc3118d618e60a66f9a247e7605c39' ){
                    $country_group = CountryGroup::find($field['value']);
                    $crmApi->setSystemZone($country_group->list_title);
                }

            }

            $agent = json_decode($message->agent, TRUE);
            $crmSend = $crmApi->send();

            $crmData = [
                'ip' => $message->ip,
                'user_agent' => $agent['raw'],
                'type' => 'contact_form',
                'request' => $crmSend['request'],
                'status' => $crmSend['status'],
                'response' => $crmSend['response']
            ];

            CrmInfo::create($crmData);
            \DB::table('messages')->where('id', $message->id)->update([
                'is_crm' => $crmSend['status'] ? 1 : 0,
                'request' => $crmSend['request'],
                'response' => $crmSend['response']
            ]);

        }
    }
}
