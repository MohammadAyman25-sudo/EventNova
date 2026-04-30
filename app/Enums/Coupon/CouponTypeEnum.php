<?php

namespace App\Enums\Coupon;

enum CouponTypeEnum:int
{
    case FIXED = 0;
    case PERCENT = 1;
    case FREE_TICKET = 2;
    case FIXED_PER_TICKET = 3;
}