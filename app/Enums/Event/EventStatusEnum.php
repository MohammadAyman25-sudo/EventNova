<?php

namespace App\Enums\Event;

enum EventStatusEnum:int 
{
    case DRAFT = 0;
    case PUBLISHED = 1;
    case CANCELLED = 2;
}