<?php

namespace App\Policies;

use App\Enums\Event\EventStatusEnum;
use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        return (int) $event->status === EventStatusEnum::PUBLISHED->value
               || $user->hasRole('super-admin')
               || $user->id === $event->organizer_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-own-events') ||
               $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('edit-own-events') ||
               $user->hasRole('super-admin') || 
               $event->organizer_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('delete-own-events') ||
               $user->hasRole('super-admin') ||
               $user->id === $event->organizer_id;
    }

    public function publish (User $user, Event $event): bool
    {
        return $this->update($user, $event);
    }
}
