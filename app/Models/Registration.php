<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'ticket_id',
        'user_id',
        'qrcode',
        'checked_in_at',
    ];

    protected $casts = [
        'qrcode' => 'encrypted',
        'checked_in_at' => 'datetime',
    ];

    public function attendee()
    {
        return $this->belongsToMany(User::class);
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class);
    }
}
