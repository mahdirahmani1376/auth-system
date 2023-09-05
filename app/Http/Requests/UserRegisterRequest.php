<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'name' => ['required','string','max:255'],
            'email' => ['required','string','max:255','email','unique:users'],
            'password' => ['required','string','min:8','confirmed'],
            'phone_number' => ['nullable','digits:11','nullable']
        ];
    }
}
