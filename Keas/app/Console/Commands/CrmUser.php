<?php

namespace App\Console\Commands;

use App\CrmInfo;
use App\Foundation\Crm\KeasClub;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CrmUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:user';

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
        CrmInfo::where('type', 'keas_club')->where('status', 0)->delete();
        $users = User::where('is_crm', 0)->where('status', 1)->get();
        foreach( $users as $user ){
            $crmApi = new KeasClub();
            $crmApi->setName($user->first_name);
            $crmApi->setSurname($user->last_name);
            $crmApi->setPhone($user->phone);
            $crmApi->setEmail($user->email);
            $crmApi->setJob($user->data['job']);
            $crmApi->setProducts($user->data['products']);
            $crmApi->setZip($user->data['zip_code']);
            $crmApi->setCountry($user->data['country']);
            $crmApi->setCity(is_null($user->data['city']) ? "Unknown" : $user->data['city']);
            $crmApi->setIp($user->ip);
            $crmApi->setEmailPermission($user->is_email == 1);
            $crmApi->setSmsPermission($user->is_sms == 1);
            $crmApi->setSource(isset($user->data['source']) && $user->data['source']  == 'mobile' ? 0 : 2);
            $crmApi->setCrmId($user->crm_id);
            $crmApi->setAddress($user->data['address']);
            $crmSend = $crmApi->send();
            $crmData = [
                'ip' => $user->ip,
                'user_agent' => $user->user_agent,
                'type' => 'keas_club',
                'request' => $crmSend['request'],
                'status' => $crmSend['status'],
                'response' => $crmSend['response']
            ];
            CrmInfo::create($crmData);
            if( $crmSend['status'] ){
                $user->is_crm = 1;
                $user->crm_id = $crmSend['response']['Result']['CrmId'];

            }
            $user->request = $crmData['request'];
            $user->response = $crmData['response'];
            $user->save();
        }

    }
}
