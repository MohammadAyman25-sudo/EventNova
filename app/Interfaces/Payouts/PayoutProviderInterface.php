<?php

namespace App\Interfaces\Payouts;

interface PayoutProviderInterface
{
  public function getPayoutDetails();
  public function createPayout();
}