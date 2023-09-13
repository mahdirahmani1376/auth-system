<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Contracts;
use GuzzleHttp\Client;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class EmailProvider implements Contracts\Provider
{

    public function __construct(
        public User $user,
        public Mailable $mail,
    )
    {

    }

    public function send()
    {
        return Mail::to($this->user)->send($this->mail);
    }
}
