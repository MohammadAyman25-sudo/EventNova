<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'user_id',
        'gateway',
        'type',
        'purpose',
        'gateway_token',
        'metadata',
        'is_default',
    ];

    protected $casts = [
        'gateway_token' => 'encrypted',
        'metadata' => 'array',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
