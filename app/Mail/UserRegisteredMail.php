<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $firstName;
    public string $lastName;

    public function __construct()
    {
        $this->firstName = 'mahdi';
        $this->lastName = 'rahmani';
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'User Created',
        );
    }

    public function content()
    {
        return new Content(
            markdown: 'emails.user-registered',
        );
    }

    public function attachments()
    {
        return [];
    }
}
