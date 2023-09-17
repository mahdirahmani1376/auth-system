<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function reset(ResetPasswordRequest $request)
    {
		$response = Password::broker()->reset($request->only('password_confirmation','password','email','token'),function (User $user,$password){
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        return $response === Password::PASSWORD_RESET
            ? redirect()->route('auth.login')->with('passwordChanged',true)
            : back()->with('cantChangePassword',true);
    }
}
