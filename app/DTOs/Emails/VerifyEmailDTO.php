<?php

namespace App\DTOs\Emails;

use App\Models\User;
use Spatie\LaravelData\Data;

class VerifyEmailDTO extends Data 
{
    public User $user;

    public string $verificatoinUrl;
}