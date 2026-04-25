<?php

namespace App\Enums\Payment;

enum PaymentMethodEnum:int
{
  case MOBILE_WALLET = 0;
  case VISA = 1;
  case PAYPAL = 2;

  public static function toArray()
  {
    return [
      self::MOBILE_WALLET => self::MOBILE_WALLET->value,
      self::PAYPAL => self::PAYPAL->value,
      self::VISA => self::VISA->value,
    ];
  }
}