<?php

namespace App\Repositories\SocialAccount;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class SocialAccountRepository
{
    public function create (User $user, string $provider, $socialAccountData)
    {
        $socialAccount = new SocialAccount();
        $socialAccount->user_id = $user->id;
        $socialAccount->provider = $provider;
        $socialAccount->provider_id = $socialAccountData['provider']->id ?? $socialAccountData['id'];
        $socialAccount->provider_user_data = $socialAccountData['user'];
        $socialAccount->access_token = $socialAccountData['token'];
        $socialAccount->refresh_token = $socialAccountData['refreshToken'];
        $socialAccount->expires_at = now()->addSeconds($socialAccountData['expiresIn']);
        $socialAccount->save();
    }

    public function getUserByProviderId(string $providerId):?User
    {
        $socialAccount = ($this->initialQuery()->where('provider_id', $providerId))->first();
        return $socialAccount ? $socialAccount->user()->first() : null;
    }

    private function initialQuery():Builder
    {
        return (new SocialAccount())->newModelQuery();
    }
}