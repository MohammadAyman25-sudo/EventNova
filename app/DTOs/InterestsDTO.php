<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class InterestsDTO extends Data
{
    public array $interests;
    public ?array $notification_preferences;
}