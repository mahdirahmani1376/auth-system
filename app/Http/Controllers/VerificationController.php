<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verified');
        $this->middleware('throttle:6,1')->only('verify','resend');
    }

    public function send()
    {
		Auth::user()->sendEmailVerificationNotification();
        return back()->with('verificationEmailSent',true);
    }

    public function verify(Request $request)
    {
        if (! $request->user()->email === $request->query('email')){
            throw new AuthorizationException();
        }

        if (Auth::user()->hasVerifiedEmail()){
            return redirect()->route('home');
        }

        $request->user()->markEmailAsVerified();

        session()->forget('mustVerifyEmail');

        return redirect()->route('home')->with('emailHasVerified',true);
    }
}
