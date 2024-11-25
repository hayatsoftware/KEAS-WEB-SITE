<?php

namespace App\Foundation\Crm;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class KeasClub {

    private string $name;
    private string $surname;
    private string $phone;
    private string $email;
    private int $job;
    private array $products;
    private string $country;
    private ?string $city;
    private ?string $address;
    private bool $kvkk = true;
    private ?int $zip;
    private string $ip;
    private bool $smsPermission = false;
    private bool $emailPermission = false;
    private int $source;
    private string $url;
    private ?string $crm_id;


    public function __construct(){
        $this->url = config('services.crm.test.keas_club.url');
    }

    public function send(): array
    {
        $client = new Client(['verify' => false]);
        $params = [
            'Ad' => $this->name,
            'Soyad' => $this->surname,
            'MobilePhone' => $this->phone,
            'EmailAddress1' => $this->email,
            'Meslek' => $this->job,
            'TercihEdilenUrunler' => $this->products,
            'UlkeAdi' => $this->country,
            'Sehir' => $this->city,
            'Adres' => $this->address,
            'PostaKodu' => $this->zip,
            'Sifre' => '321321xX',
            'SifreTekrar' => '321321xX',
            'IPBilgisi' => $this->ip,
            'Kayit_kaynagi' => $this->source,
            'KvvkIzın' => $this->kvkk,
            'SmsIzın' => $this->smsPermission,
            'EPostaIzın' => $this->emailPermission
        ];
        if( !is_null($this->crm_id) ){
            $params['CrmId'] = $this->crm_id;
        }
        try {
            $response = $client->post($this->url,
                [
                    'json' => $params
                ]
            );
            $response = json_decode($response->getBody()->getContents(), TRUE);
            //Log::info('keas_club_crm', ['response'=>$response]);
            return [
                'status' => $response['Success'],
                'request' => $params,
                'response' => $response
            ];

        } catch (\Exception $e) {
            //Log::info('keas_club_crm_error', ['error'=>$e->getMessage()]);
            return [
                'status' => 0,
                'request' => $params,
                'response' => null
            ];
        }
    }

    public function setCrmId($id):? string
    {
        return $this->crm_id = $id;
    }

    public function setName($name): string
    {
        return $this->name = $name;
    }

    public function setSurname($surname): string
    {
        return $this->surname = $surname;
    }

    public function setPhone($phone): string
    {
        return $this->phone = $phone;
    }

    public function setEmail($email): string
    {
        return $this->email = $email;
    }

    public function setCountry($country): string
    {
        return $this->country = $country;
    }

    public function setCity($city):? string
    {
        return $this->city = $city;
    }

    public function setSmsPermission($is_sms): bool
    {
        return $this->smsPermission = $is_sms;
    }

    public function setEmailPermission($is_email): bool
    {
        return $this->emailPermission = $is_email;
    }

    public function setIp($ip): string
    {
        return $this->ip = $ip;
    }

    public function setJob($job): int
    {
        return $this->job = $job;
    }

    public function setProducts($products): array
    {
        return $this->products = $products;
    }

    public function setSource($source): int
    {
        return $this->source = $source;
    }

    public function setZip($zip):? int
    {
        return $this->zip = $zip;
    }

    public function setAddress($address):? string
    {
        return $this->address = $address;
    }


}
