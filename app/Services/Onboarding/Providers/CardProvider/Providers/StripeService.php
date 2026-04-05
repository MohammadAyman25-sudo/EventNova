<?php

namespace App\Services\Onboarding\Providers\CardProvider\Providers;

use App\Interfaces\Payments\PaymentProviderInteface;

class StripeService implements PaymentProviderInteface
{
  public function getPaymentDetails()
  {
    throw new \Exception('Not implemented');
  }

  public function createPayment()
  {
    throw new \Exception('Not implemented');
  }
}