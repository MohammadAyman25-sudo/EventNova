<?php

namespace App\Enums\Ticket;

enum TicketStatusEnum:int
{
    case CONFIRMED = 0;
    case REFUNDED = 1;
    case CANCELLED = 2;
    case PENDING = 3;
    case CHECKED_IN = 4;
    case FAILED = 5;

    public static function toArray()
    {
        return array_column(self::cases(), 'value');
    }
}