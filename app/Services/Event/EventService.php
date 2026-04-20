<?php

namespace App\Services\Event;

use App\DTOs\Event\CreateNewEventDTO;
use App\DTOs\Event\UpdateEventDTO;
use App\Models\Event;
use App\Models\User;
use Exception;

class EventService
{
  public function createEvent(User $user, CreateNewEventDTO $eventDTO)
  {
    if (!$user->hasPermissionTo('create-own-events')) {
      throw new Exception(trans("event.unauthorized.create"));
    }
    $newEvent = Event::create($eventDTO->toArray());
    return $newEvent;
  }

  public function listEvents()
  {
    return Event::paginate(25);
  }

  public function updateEvent(User $user, Event $event, UpdateEventDTO $eventDTO)
  {
    if (!$user->hasPermissionTo('edit-own-events') || $user->id !== $event->organizer_id) {
      throw new Exception(trans("event.unauthorized.update"));
    }
    $event->update($eventDTO->toArray());
  }

  public function deleteEvent(User $user, Event $event)
  {
    if (!$user->hasPermissionTo('delete-own-events') || $user->id !== $event->organizer_id) {
      throw new Exception(trans("event.unauthorized.delete"));
    }
    $event->delete();
  }
}