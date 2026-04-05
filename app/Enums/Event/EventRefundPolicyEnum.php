<?php

namespace App\Enums\Event;

enum EventRefundPolicyEnum:int
{
    case FULL_REFUND_BEFORE = 0;
    case PARTIAL_REFUND_BEFORE = 1;
    case CASE_BY_CASE = 2;

    public static function toArray() {
        return array_column(self::cases(), 'value');
    }
}