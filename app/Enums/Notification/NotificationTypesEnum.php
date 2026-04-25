<?php

namespace App\Enums\Notification;

enum NotificationTypesEnum:int
{
    case EMAIL = 0;
    case PUSH_NOTIFICATION = 1; 
}