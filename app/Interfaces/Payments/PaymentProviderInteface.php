<?php

namespace App\Interfaces\Payments;

interface PaymentProviderInteface
{
  public function createPayment();

  public function getPaymentDetails();
}