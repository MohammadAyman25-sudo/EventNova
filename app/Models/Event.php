<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'status',
        'type',
        'location',
        'venue_name',
        'venue_address',
        'online_link',
        'capacity',
        'banner_image',
        'organizer_id',
        'refund_policy',
        'refund_days_before',
        'refund_percentage',
        'allow_refund_after_start',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'location' => 'array',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
}
