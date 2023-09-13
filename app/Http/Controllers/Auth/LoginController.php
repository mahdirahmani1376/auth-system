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
        $request->authenticate();

        if ($this->attemptLogin($request)) {
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
        return back()->with('wrongCredentials', true);
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

    public function attemptLogin(LoginRequest $request)
    {
        return auth()->attempt($request->only(['password','email']),$request->boolean('remember'));
    }
}
