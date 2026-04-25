<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'quantity_available',
        'sales_start',
        'sales_end',
        'max_per_order',
        'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
