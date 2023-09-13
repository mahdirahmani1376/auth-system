<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Contracts;
use GuzzleHttp\Client;

class SmsProvider implements Contracts\Provider
{

    public function __construct(
        public User $user,
        public string $text,
    )
    {

    }

    public function send()
    {
        $client = new Client();
        $response = $client->post(config('services.sms.uri'),$this->prepareDataForSms($this->user,$this->text));
        return $response->getBody();
    }

    private function prepareDataForSms(User $user,string $text)
    {
        $data =
            array_merge(
                config('services.sms.auth'),
                [
                ]
            );

        return [
            'json' => $data
        ];
    }
}
