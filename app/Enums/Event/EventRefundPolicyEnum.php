<?php

namespace App\Enums\Event;

enum EventRefundPolicyEnum:string
{
    case FULL_REFUND_BEFORE = 'FULL_REFUND_BEFORE';
    case PARTIAL_REFUND_BEFORE = 'PARTIAL_REFUND_BEFORE';
    case CASE_BY_CASE = 'CASE_BY_CASE';

    public static function toArray() {
        return array_column(self::cases(), 'value');
    }
}