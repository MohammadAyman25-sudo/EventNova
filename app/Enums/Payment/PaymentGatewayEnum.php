<?php

namespace App\Enums\Payment;

enum PaymentGatewayEnum:string
{
    case STRIPE = 'stripe';
    case PAYPAL = 'paypal';
}