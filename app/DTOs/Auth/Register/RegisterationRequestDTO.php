<?php

namespace App\DTOs\Auth\Register;

use Spatie\LaravelData\Data;

class RegisterationRequestDTO extends Data
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;
    public string $password_confirmation;
}