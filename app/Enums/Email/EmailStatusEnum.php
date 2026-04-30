<?php

namespace App\Enums\Email;

enum EmailStatusEnum:int
{
    // Pre-sending
    case DRAFT = 0;
    case SCHEDULED = 1;
    case PROCESSED = 2;
    case QUEUED = 3;
    // sending and post sending
    case SENT = 4;
    case DELIVERED = 5;
    case DELIVERY_DELAYED = 6;
    case HARD_BOUNCE = 7;
    case SOFT_BOUNCE = 8;
    case COMPLAINED = 9;
    case OPENED = 10;
    case CLICKED = 11;
    case UNSUBSCRIBED = 12;
    // failed
    case FAILED = 13;
    case REJECTED = 14;
    case BLOCKED = 15;
}