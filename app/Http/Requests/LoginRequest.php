<?php

namespace App\Http\Requests;

use App\Rules\RecaptchaRule;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required','email','exists:users,email'],
            'password' => ['required'],
            'g-recaptcha-response' => ['required',new RecaptchaRule()]
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => __('auth.recaptcha')
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

		if (! Auth::attempt($this->only('email','password'),$this->input('remember'))){
            RateLimiter::hit($this->throttleKey());
			throw ValidationException::withMessages([
               'email' => trans('auth.failed')
            ]);
        }

        RateLimiter::clear($this->throttleKey());

    }

    public function ensureIsNotRateLimited()
    {
		if (! RateLimiter::tooManyAttempts($this->throttleKey(),5)){
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle',[
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey()
    {
        return Str::transliterate(Str::lower($this->input('email')."|".request()->ip()));
    }
}
