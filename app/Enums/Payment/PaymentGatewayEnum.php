<?php

namespace App\Enums\Payment;

enum PaymentGatewayEnum:int
{
    case STRIPE = 0;
    case PAYMOB = 1;
    case PAYPAL = 2;
}