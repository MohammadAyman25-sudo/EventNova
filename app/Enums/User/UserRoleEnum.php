<?php

namespace App\Enums\User;

enum UserRoleEnum:int
{
    case ORGANIZER = 0;

    case ATTENDEE = 1;
}