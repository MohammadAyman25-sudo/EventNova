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
            
            $userRecord = (new SocialAccountRepository())->getUserByProviderId($user->id);
            if ($userRecord) {
                Auth::login($userRecord, true);
                return redirect()->route('dashboard');
            }

            session([
            'pending_social_user'=>[
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'user' => $user->user,
            ],
            'provider' => $provider]);
            return redirect()->route('register-role');
        } catch (\Exception $exception) {
            Log::error($exception);
            return redirect('/login')->with('error', 'Authentication Failed');
        }
    }
}