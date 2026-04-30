<?php

namespace App\Services\Onboarding\Providers\CardProvider\Providers;

use App\Interfaces\Payments\PaymentProviderInteface;
use App\Interfaces\Payouts\PayoutProviderInterface;

class PayMobService implements PaymentProviderInteface, PayoutProviderInterface
{
  public function createPayment()
  {
    throw new \Exception('Not implemented');
  }

  public function getPaymentDetails()
  {
    throw new \Exception('Not implemented');
  }

  public function createPayout()
  {
    throw new \Exception('Not implemented');
  }

  public function getPayoutDetails()
  {
    throw new \Exception('Not implemented');
  }
}