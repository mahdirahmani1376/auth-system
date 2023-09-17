<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class RecaptchaRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
		$response = Http::post('https://www.google.com/recaptcha/api/siteverify',[
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $value,
        ]);

        if (! $response->json('success')) {
            $fail('recatptcha validation failed')->translate();
        }
    }
}
