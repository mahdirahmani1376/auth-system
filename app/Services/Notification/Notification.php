<?php

namespace App\Services\Notification;

use App\Models\User;
use App\Services\Notification\Contracts\Provider;
use GuzzleHttp\Client;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

/**
 * @method sendSms(User $user,string $text)
 * @method sendEmail(User $user,Mailable $mail)
 */
class Notification
{
    public function __call(string $name, array $args)
    {
        $providerPath = __NAMESPACE__ . "\Providers\\" . substr($name,4) . 'Provider';

        if (! class_exists($providerPath)){
            throw new \Exception("{$providerPath} class does not exists");
        }

        $providerInstance = new $providerPath(... $args);

        if (! is_subclass_of($providerInstance,Provider::class)){
            throw new \Exception("class must implements" . Provider::class);
        }

        $providerInstance->send();
    }


}
