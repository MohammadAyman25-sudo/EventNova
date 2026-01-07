<?php

namespace App\Enums\Coupon;

enum CouponStatusEnum:string
{
    case FIXED = 'fixed';
    case PERCENT = 'percent';
    case FREE_TICKET = 'free_ticket';
    case FIXED_PER_TICKET = 'fixed_per_ticket';
}