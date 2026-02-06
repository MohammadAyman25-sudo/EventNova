<?php

namespace App\Enums\Notification;

enum NotificationTypesEnum:int
{
    case EMAIL = 1;
    case PUSH_NOTIFICATION = 2; 
}