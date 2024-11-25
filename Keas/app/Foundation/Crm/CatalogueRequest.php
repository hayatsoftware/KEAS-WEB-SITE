<?php

namespace App\Foundation\Crm;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CatalogueRequest {

    private string $crm_id;
    private string $name;
    private string $surname;
    private string $phone;
    private string $email;
    private string $country;
    private string $city;
    private bool $kvkk = true;
    private ?int $zip;
    private int $source;
    private bool $smsPermission = false;
    private bool $emailPermission = false;
    private array $catalogue;
    private string $message;
    private string $url;


    public function __construct(){
        $this->url = config('services.crm.test.contact_form.url');
    }

    public function send(): array
    {
            $client = new Client(['verify' => false]);
        $params = [
            "ContactModel" => [
                'Ad' => $this->name,
                'Soyad' => $this->surname,
                'MobilePhone' => $this->phone,
                'EmailAddress1' => $this->email,
                'UlkeAdi' => $this->country,
                'Sehir' => $this->city,
                'PostaKodu' => $this->zip,
                'KvvkIzın' => $this->kvkk,
                'SmsIzın' => $this->smsPermission,
                'EPostaIzın' => $this->emailPermission
            ],
            "IncidentModel" => [
                'CrmId' => $this->crm_id,
                'Konu'=> 1,
                'Aciklama' => 'Katalog isteğidir.',
                'Kaynak' => $this->source,
                'Katalog' => $this->catalogue
            ]
        ];

        try {
            $response = $client->post($this->url,
                [
                    'json' => $params
                ]
            );
            $response = json_decode($response->getBody()->getContents(), TRUE);
            //Log::info('catalogue_form_crm', ['response'=>$response]);
            return [
                'status' => $response['Success'],
                'request' => $params,
                'response' => $response
            ];
        } catch (\Exception $e) {
            Log::info('catalogue_form_crm_error', ['error'=>$e]);
            return [
                'status' => 0,
                'request' => $params,
                'response' => null
            ];
        }
    }

    public function setCrmId($id): string
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

    public function setCity($city): string
    {
        return $this->city = $city;
    }

    public function setSmsPermission(): bool
    {
        return $this->smsPermission = true;
    }

    public function setEmailPermission(): bool
    {
        return $this->emailPermission = true;
    }

    public function setCatalogue($catalogue): array
    {
        return $this->catalogue = $catalogue;
    }

    public function setMessage($message): string
    {
        return $this->message = $message;
    }

    public function setZip($zip):? int
    {
        return $this->zip = $zip;
    }

    public function setSource($source): int
    {
        return $this->source = $source;
    }


}
