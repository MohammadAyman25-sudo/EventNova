<?php

namespace App\Enums\Email;

enum EmailStatusEnum:string
{
    // Pre-sending
    case DRAFT = 'DRAFT';
    case SCHEDULED = 'SCHEDULED';
    case PROCESSED = 'PROCESSED';
    case QUEUED = 'QUEUED';
    // sending and post sending
    case SENT = 'SENT';
    case DELIVERED = 'DELIVERED';
    case DELIVERY_DELAYED = 'DELIVERY_DELAYED';
    case HARD_BOUNCE = 'HARDLY_BOUNCED_BACK';
    case SOFT_BOUNCE = 'SOFTLY_BOUNCED_BACK';
    case COMPLAINED = 'COMPLAINED_AS_SPAM';
    case OPENED = 'OPENED';
    case CLICKED = 'CLICKED';
    case UNSUBSCRIBED = 'UNSUBSCRIBED';
    // failed
    case FAILED = 'FAILED';
    case REJECTED = 'REJECTED';
    case BLOCKED = 'BLOCKED';
}