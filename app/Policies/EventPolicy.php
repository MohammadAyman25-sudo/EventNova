<?php

namespace App\Policies;

use App\Enums\Event\EventStatusEnum;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('events.view-any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        // Published events are visible to anyone with browse permission;
        // owners can also see their own drafts/unpublished events.
        return $user->hasPermissionTo('events.view-any') ||
               ($user->hasPermissionTo('events.view-own') && $user->id === $event->organizer_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('events.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('events.edit-own') &&
               $event->organizer_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('events.delete-own') &&
               $user->id === $event->organizer_id &&
               EventStatusEnum::DRAFT->value === $event->status;
    }

    public function publish(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('events.publish-own') &&
               $user->id === $event->organizer_id;
    }

    /**
     * Determine whether the user can save / favourite the event.
     * Only attendees have this permission.
     */
    public function save(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('events.save');
    }

    /**
     * Determine whether the user can remove the event from their favourites.
     * Only attendees have this permission.
     */
    public function unsave(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('events.unsave');
    }
}
