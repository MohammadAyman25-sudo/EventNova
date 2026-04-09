<?php

namespace App\Enums\WalletTransaction;

enum WalletTransactionType:int
{
  case PAYMENT=1;

  case REFUND=2;

  case DEPOSIT=3;

  case WITHDRAWAL=4;
}