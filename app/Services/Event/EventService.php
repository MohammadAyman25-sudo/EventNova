<?php

namespace App\Services\Event;

use App\DTOs\Event\CreateNewEventDTO;
use App\DTOs\Event\UpdateEventDTO;
use App\Enums\Event\EventStatusEnum;
use App\Models\Event;
use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventService
{
  public function createEvent(User $user, CreateNewEventDTO $eventDTO): Event
  {
    if (!$user->hasPermissionTo('events.create')) {
      throw new Exception(trans("event.unauthorized.create"));
    }

    $mediaDisk  = config('filesystems.media_disk', 'r2');
    $bannerPath = $eventDTO->banner_image->storePublicly('events/banners', ['disk' => $mediaDisk]);

    $slugBase = Str::slug($eventDTO->title);
    $slug = $slugBase;
    $suffix = 0;
    while (Event::where('slug', $slug)->exists()) {
      $suffix++;
      $slug = $slugBase.'-'.$suffix;
    }

    return Event::create([
      'title' => $eventDTO->title,
      'slug' => $slug,
      'description' => $eventDTO->description,
      'start_date' => $eventDTO->start_date,
      'end_date' => $eventDTO->end_date,
      'location' => $eventDTO->location,
      'venue_name' => $eventDTO->venue_name,
      'venue_address' => $eventDTO->venue_address,
      'online_link' => $eventDTO->online_link,
      'capacity' => $eventDTO->capacity,
      'banner_image' => $bannerPath,
      'organizer_id' => $user->id,
      'status' => EventStatusEnum::DRAFT->value,
      'refund_policy' => $eventDTO->refund_policy,
      'refund_days_before' => $eventDTO->refund_days_before,
      'refund_percentage' => $eventDTO->refund_percentage,
      'allow_refunds_after_start' => $eventDTO->allow_refund_after_start,
    ]);
  }

  public function listEvents()
  {
    return Event::whereIn('status', [EventStatusEnum::PUBLISHED->value, EventStatusEnum::CANCELLED->value])->paginate(25);
  }

  public function listOrganizerEvents(User $user)
  {
    return Event::where('organizer_id', $user->id)->paginate(25);
  }

  public function updateEvent(User $user, Event $event, UpdateEventDTO $eventDTO, ?UploadedFile $newBanner = null): void
  {
    if (! $user->can('update', $event)) {
      throw new Exception(trans('event.unauthorized.update'));
    }

    if ($event->title !== $eventDTO->title) {
      $slugBase = Str::slug($eventDTO->title);
      $slug = $slugBase;
      $suffix = 0;
      while (Event::where('slug', $slug)->where('id', '!=', $event->id)->exists()) {
        $suffix++;
        $slug = $slugBase.'-'.$suffix;
      }
      $event->slug = $slug;
    }

    $payload = [
      'title' => $eventDTO->title,
      'slug' => $event->slug,
      'description' => $eventDTO->description,
      'start_date' => $eventDTO->start_date,
      'end_date' => $eventDTO->end_date,
      'location' => $eventDTO->location,
      'venue_name' => $eventDTO->venue_name,
      'venue_address' => $eventDTO->venue_address,
      'online_link' => $eventDTO->online_link,
      'capacity' => $eventDTO->capacity,
      'refund_policy' => $eventDTO->refund_policy,
      'refund_days_before' => $eventDTO->refund_days_before,
      'refund_percentage' => $eventDTO->refund_percentage,
      'allow_refunds_after_start' => $eventDTO->allow_refund_after_start,
    ];

    if ($newBanner instanceof UploadedFile) {
      $mediaDisk = config('filesystems.media_disk', 'r2');
      if ($event->banner_image) {
        Storage::disk($mediaDisk)->delete($event->banner_image);
      }
      $payload['banner_image'] = $newBanner->storePublicly('events/banners', ['disk' => $mediaDisk]);
    }

    $event->update($payload);
  }

  public function deleteEvent(User $user, Event $event): void
  {
    if (! $user->can('delete', $event)) {
      throw new Exception(trans('event.unauthorized.delete'));
    }
    if ($event->banner_image) {
      Storage::disk(config('filesystems.media_disk', 'r2'))->delete($event->banner_image);
    }
    $event->delete();
  }

  public function publishEvent(User $user, Event $event): void
  {
    if (! $user->can('publish', $event)) {
      throw new Exception(trans('event.unauthorized.publish'));
    }
    $event->status = EventStatusEnum::PUBLISHED->value;
    $event->save();
  }
}