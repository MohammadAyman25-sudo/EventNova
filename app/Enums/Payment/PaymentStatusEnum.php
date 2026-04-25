<?php

namespace App\Enums\Payment;

enum PaymentStatusEnum:int
{
    case PENDING = 0;
    case REQUIRES_ACTION = 1;
    case PROCESSING = 2;
    case SUCCEEDED = 3;
    case FAILED = 4;
    case CANCELLED = 5;
    case REFUNDED = 6;
    case PARTIALLY_REFUNDED = 7;
}