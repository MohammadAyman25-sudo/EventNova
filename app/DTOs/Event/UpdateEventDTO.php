<?php

namespace App\DTOs\Event;

use Spatie\LaravelData\Data;

class UpdateEventDTO extends Data
{
    public string $title;

    public ?string $description;

    public string $start_date;

    public string $end_date;

    public ?array $location;

    public string $venue_name;

    public ?string $venue_address;

    public ?string $online_link;

    public int $capacity;

    public int $refund_policy;

    public ?int $refund_days_before;

    public int $refund_percentage;

    public bool $allow_refund_after_start;
}
