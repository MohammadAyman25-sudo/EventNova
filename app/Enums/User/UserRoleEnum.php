<?php

namespace App\Enums\User;

enum UserRoleEnum:string
{
    case ORGANIZER = 'organizer';

    case ATTENDEE = 'attendee';
}