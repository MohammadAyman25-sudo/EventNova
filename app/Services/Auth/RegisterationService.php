<?php

namespace App\Services\Auth;

use App\DTOs\Auth\Register\RegisterationRequestDTO;
use App\Repositories\User\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterationService
{
    public function register(RegisterationRequestDTO $registerationRequestDTO)
    {
        $user = (new UserRepository())->create($registerationRequestDTO);
        event(new Registered($user));

        Auth::login($user);
    }
}