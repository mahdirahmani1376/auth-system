<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;

class SendVerificationEmailListener
{
    public function __construct()
    {
    }

    public function handle(UserRegisteredEvent $event): void
    {
		$event->user->sendEmailVerificationNotification();
    }
}
