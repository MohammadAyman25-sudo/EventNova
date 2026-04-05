<?php

namespace App\Services\Onboarding\Providers\CardProvider\Providers;

use App\Interfaces\Payments\PaymentProviderInteface;

class PayMobService implements PaymentProviderInteface
{
  public function createPayment()
  {
    throw new \Exception('Not implemented');
  }

  public function getPaymentDetails()
  {
    throw new \Exception('Not implemented');
  }
}