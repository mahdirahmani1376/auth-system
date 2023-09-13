<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Contracts;
use GuzzleHttp\Client;
use Illuminate\Mail\Mailable;

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
		return $this->mail->to($this->user->email);
    }
}
