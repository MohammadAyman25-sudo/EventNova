<?php

namespace App\Enums\Ticket;

enum TicketStatusEnum:string
{
    case CONFIRMED = 'confirmed';
    case REFUNDED = 'refunded';
    case CANCELLED = 'cancelled';
    case PENDING = 'pending';
    case CHECKED_IN = 'checked_in';
    case FAILED = 'failed';

    public static function toArray()
    {
        return array_column(self::cases(), 'value');
    }
}