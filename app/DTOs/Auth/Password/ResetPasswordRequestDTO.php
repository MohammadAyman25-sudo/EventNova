<?php

namespace App\DTOs\Auth\Password;

use Spatie\LaravelData\Data;

class ResetPasswordRequestDTO extends Data
{
    public string $token;
    public string $email;
    public string $password;
    public string $password_confirmation;
}