<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm(UserRegisterRequest $request)
    {
		$data = $request->validated();
        User::create($data);
        return redirect()->route('home')->with('registered',true);
    }

    public function register()
    {
        return view('auth.register');
    }
}
