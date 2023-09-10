<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        auth()->attempt($request->only('email','password'),$request->filled('remember'));

        if ($this->attempLogin($request)){
            return $this->sendSuccessResponse();
        }

        return $this->sendLoginFailedResponse();
    }

    protected function sendSuccessResponse()
    {
        session()->regenerate();
        return redirect()->intended();
    }

    protected function sendLoginFailedResponse()
    {
        return back()->with('wrongCredentials',true);
    }

    public function logout()
    {
        session()->invalidate();

        auth()->logout();

        return redirect()->route('home');
    }

    public function username()
    {
        return 'email';
    }
}
