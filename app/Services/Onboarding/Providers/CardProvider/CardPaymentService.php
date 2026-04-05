<?php

namespace App\Services\Onboarding\Providers\CardProvider;

use App\Constant\SystemConstants;
use App\Services\Onboarding\Providers\CardProvider\Providers\PayMobService;
use App\Services\Onboarding\Providers\CardProvider\Providers\StripeService;

class CardPaymentService
{
  public function getPaymentGateway(string $countryCode)
  {
    $paymobCountries = SystemConstants::PAYMOB_COUNTRY_CODE;
    if (in_array($countryCode, $paymobCountries)) {
      return new PayMobService();
    }
    return new StripeService();
  }
}