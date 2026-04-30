<?php

namespace App\Enums\User;

enum OnboardingStatusEnum:int
{
  case PENDING = 0;
  case FAILED = 1;
  case INCOMPLETED = 2;
  case COMPLETED = 3;
}