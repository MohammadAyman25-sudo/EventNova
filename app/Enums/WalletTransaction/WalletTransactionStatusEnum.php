<?php

namespace App\Enums\WalletTransaction;

enum WalletTransactionStatusEnum:int
{
  case PENDING = 1;
  case PROCESSING = 2;
  case COMPLETED = 3;
  case FAILED = 4;
  case CANCELLED = 5;
  case ESCROW = 6;
  case REFUNDED = 7;
}