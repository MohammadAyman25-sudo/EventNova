<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\SocialAuthService;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return (new SocialAuthService())->redirect($provider);
    }

    public function handleProviderCallback($provider)
    {
        return (new SocialAuthService())->callback($provider);
    }
}
