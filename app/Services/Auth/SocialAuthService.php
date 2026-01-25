<?php

namespace App\Services\Auth;

use App\Repositories\SocialAccount\SocialAccountRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            
            $userRecord = (new SocialAccountRepository())->getUserByProviderId($user->id);
            if ($userRecord) {
                Auth::login($userRecord);
                return redirect()->route('dashboard');
            }
            return redirect()->route('register-role');
        } catch (\Exception $th) {
            Log::error($th);
            return redirect('/login')->with('error', 'Authentication Failed');
        }
    }
}