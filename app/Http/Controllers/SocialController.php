<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToProvider($driver)
    {
		return Socialite::driver($driver)->redirect();
    }

    public function callbackProvider($driver)
    {
        $socialiteUser = Socialite::driver($driver)->user();

        $user = User::firstOrCreate([
            'email' => $socialiteUser->getEmail()
        ],[
           'email' => $socialiteUser->getEmail(),
           'name' => $socialiteUser->getName(),
           'provider_id' => $socialiteUser->getId(),
           'avatar' => $socialiteUser->getAvatar(),
           'email_verified_at' => now()
        ]);

        Auth::login($user);

        return redirect()->intended();
    }
}
