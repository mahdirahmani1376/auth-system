<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm(UserRegisterRequest $request)
    {
		$data = $request->validated();
        $user = User::create($data);

        Auth::login($user);

        event(new UserRegisteredEvent($user));

        return redirect()->route('home')->with('registered',true);
    }

    public function register()
    {
        return view('auth.register');
    }
}
