<?php

namespace App\Enums\Order;

enum OrderStatusEnum:int
{
    case PENDING = 0;
    case AWAITING_PAYMENT = 1;
    case PAID = 2;
    case PARTIALLY_REFUNDED = 3;
    case REFUNDED = 4;
    case CANCELLED = 5;
    case FAILED = 6;
    case EXPIRED = 7;
}