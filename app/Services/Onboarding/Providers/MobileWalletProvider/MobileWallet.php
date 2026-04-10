<?php

namespace App\Services\Onboarding\Providers\MobileWalletProvider;

use App\Interfaces\Payments\PaymentProviderInteface;
use App\Interfaces\Payouts\PayoutProviderInterface;

class MobileWalletProvider implements PaymentProviderInteface, PayoutProviderInterface
{
  public function getPaymentDetails()
  {
    throw new \Exception('Not implemented');
  }

  public function createPayment()
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