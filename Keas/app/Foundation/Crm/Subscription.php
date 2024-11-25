<?php

namespace App\Foundation\Crm;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Mediapress\Modules\Content\Models\PageDetail;


class Subscription {

    private string $email;
    private array $subject;
    private string $url;
    private bool $kvkk = true;
    private bool $aydinlatma = false;
    private string $language;
    private string $country;
    private int $source;

    public function __construct(){
        $this->url = config('services.crm.test.subscription.url');
    }

    public function send(): array
    {
        $client = new Client(['verify' => false]);
        $params = [
            'Email' => $this->email,
            'Konu' => $this->subject,
            'kvkk_onay' => $this->kvkk,
            'aydinlatma_metni' => $this->aydinlatma,
            'Country' => $this->country,
            'Language' => $this->language,
            'Kaynak' => $this->source
        ];

        try {
            $response = $client->post($this->url,
                [
                    'timeout' => 10,
                    'connect_timeout' => 10,
                ],
                [
                    'json' => $params
                ]
            );

            $response = json_decode($response->getBody()->getContents(), TRUE);
            //Log::info('subscription_crm', ['response'=>$response]);
            return [
                'status' => $response['Success'],
                'request' => $params,
                'response' => $response
            ];

        } catch (GuzzleException $e) {
            Log::error('subscription_crm_error', ['error'=>$e]);
            return [
                'status' => false,
                'request' => $params,
                'response' => null,
                'err' => $e->getMessage()
            ];
        }

    }

    public function setEmail($email): string
    {
        return $this->email = $email;
    }

    public function setSubject($subject): array
    {
        return $this->subject = $subject;
    }

    public function setAydinlatma($value): bool
    {
        return $this->aydinlatma = $value;
    }

    public function setCountry($country): string
    {
        return $this->country = $country;
    }

    public function setLanguage($language): string
    {
        return $this->language = $language;
    }

    public function setSource($source): int
    {
        return $this->source = $source;
    }


}
