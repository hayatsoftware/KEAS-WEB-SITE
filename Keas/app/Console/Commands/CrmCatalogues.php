<?php

namespace App\Console\Commands;

use App\CrmCatalogue;
use App\CrmInfo;
use App\Foundation\Crm\CatalogueRequest;
use App\User;
use Illuminate\Console\Command;

class CrmCatalogues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:catalogue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        CrmInfo::where('type', 'crm_catalogue')->where('status', 0)->delete();
        $catalogues = CrmCatalogue::where('status', 0)->get();
        foreach( $catalogues as $catalogue ){
            $user = User::find($catalogue->user_id);
            if($user && $user->crm_id){
                $crmApi = new CatalogueRequest();
                $crmApi->setCrmId($user->crm_id);
                $crmApi->setName($user->first_name);
                $crmApi->setSurname($user->last_name);
                $crmApi->setPhone($user->phone);
                $crmApi->setEmail($user->email);
                $crmApi->setZip($user->data['zip_code']);
                $crmApi->setCountry($user->data['country']);
                $crmApi->setCity($user->data['city']);
                $crmApi->setEmailPermission($user->is_email == 1);
                $crmApi->setSmsPermission($user->is_sms == 1);
                $crmApi->setSource($catalogue->source);
                $crmApi->setCatalogue($catalogue->catalogues);
                $crmSend = $crmApi->send();
                $crmData = [
                    'ip' => $catalogue->ip,
                    'user_agent' => $catalogue->user_agent,
                    'country_group_id' => $catalogue->country_group_id,
                    'language_id' => $catalogue->language_id,
                    'type' => 'crm_catalogue',
                    'request' => $crmSend['request'],
                    'status' => $crmSend['status']
                ];
                if( $crmSend['status'] ){
                    $crmData['response'] = $crmSend['response'];
                    $catalogue->status = 1;
                    $catalogue->save();
                }
                CrmInfo::create($crmData);
            }

        }
    }
}
