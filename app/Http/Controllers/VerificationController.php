<?php

namespace App\Http\Controllers;

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
//        if (Auth::user()->hasVerifiedEmail()){
//            return redirect()->route('home');
//        }

		Auth::user()->sendEmailVerificationNotification();
        return back()->with('verificationEmailSent',true);
    }
}
