<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgetPasswordController extends Controller
{
    public function showForgetForm()
    {
		return view('auth.forget-password');
    }

    public function showResetForm(Request $request)
    {
        return view('auth.reset-password',[
            'email' => $request->query('email'),
            'token' => $request->query('token'),
        ]);
    }

    public function sendResetLink(ForgetPasswordRequest $request)
    {
		$response = Password::sendResetLink($request->only('email'));

		if ($response === Password::RESET_LINK_SENT){
            return back()->with('resetLinkSent',true);
        }

        return back()->with('resetLinkFailed',true);
    }


}
