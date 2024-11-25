<?php

namespace App\Console\Commands;

use App\CrmInfo;
use App\CrmSubscriptions;
use App\Foundation\Crm\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CrmSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:subscription';

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
        CrmInfo::where('type', 'subscription')->where('status', 0)->delete();
        $subscriptions = CrmSubscriptions::where('status', 0)->get();

        foreach( $subscriptions as $subscription ){
            $crmApi = new Subscription();
            $crmApi->setEmail($subscription->email);
            $crmApi->setSubject($subscription->products);
            $crmApi->setAydinlatma(true);
            $crmApi->setCountry(setCountryForCrm($subscription->country_group_id));
            $crmApi->setLanguage(setLanguageForCrm($subscription->language_id));
            $crmApi->setSource($subscription->source);
            $crmSend = $crmApi->send();
            $crmData = [
                'ip' => $subscription->ip,
                'user_agent' => $subscription->user_agent,
                'country_group_id' => $subscription->country_group_id,
                'language_id' => $subscription->language_id,
                'type' => 'subscription',
                'request' => $crmSend['request'],
                'status' => $crmSend['status']
            ];

            if( $crmSend['status'] ){
                $crmData['response'] = $crmSend['response'];
                $subscription->status = 1;
                $subscription->save();
            }else{
                Log::error('Crm Subscription Err:'.$crmSend['err']);
            }
            CrmInfo::create($crmData);
        }

    }
}
