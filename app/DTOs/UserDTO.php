<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class UserDTO extends Data
{
    public string $full_name;
    public string $email;

    public function hasRole(string $role)
    {
        return false;
    }
}