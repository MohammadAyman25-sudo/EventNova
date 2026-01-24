<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'provider_user_data',
        'access_token',
        'refresh_token',
        'expires_at',
    ];

    protected $casts = [
        'provider_user_data' => 'array',
    ];
}
