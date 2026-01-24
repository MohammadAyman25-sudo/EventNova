<?php

namespace App\Services\Auth;

use Laravel\Socialite\Facades\Socialite;

class SocialAuthService
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();

            session(['pending_social_user'=>$user]);
            session(['provider' => $provider]);
            return redirect()->route('register-role');
        } catch (\Exception $th) {
            return redirect('/login');
        }
    }
}