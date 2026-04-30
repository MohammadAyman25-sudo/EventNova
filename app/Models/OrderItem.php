<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'ticket_type_id',
        'quantity',
        'price_at_purchase',
        'sub_total',
        'discount_amount',
    ];

    public function tickets()
    {
        $this->hasMany(TicketType::class);
    }
}
