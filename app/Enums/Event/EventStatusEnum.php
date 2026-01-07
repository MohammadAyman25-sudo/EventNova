<?php

namespace App\Enums\Event;

enum EventStatusEnum: string 
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case CANCELLED = 'cancelled';
}