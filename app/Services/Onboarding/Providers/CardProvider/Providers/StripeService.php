<?php

namespace App\Services\Onboarding\Providers\CardProvider\Providers;

use App\Interfaces\Payments\PaymentProviderInteface;
use App\Interfaces\Payouts\PayoutProviderInterface;
use Stripe\Account;
use Stripe\AccountLink;
use Stripe\Stripe;

class StripeService implements PaymentProviderInteface, PayoutProviderInterface
{

  public function __construct()
  {
    Stripe::setApiKey(config('services.stripe.secret'));
  }

  public function createConnectedAccount()
  {
    return Account::create([
      'type' => 'express',
    ]);
  }

  public function createOnboardingLink($accountId)
  {
    return AccountLink::create([
      'account' => $accountId,
      'refersh_url' => route('stripe.refresh'),
      'return_url' => route('stripe.return'),
      'type' => 'account_onboarding',
    ]);
  }

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