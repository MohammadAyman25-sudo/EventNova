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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-own-events');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('edit-own-events') ||
               $event->organizer_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('delete-own-events') ||
        $user->id === $event->organizer_id &&
        EventStatusEnum::DRAFT->value === $event->status;
    }

    public function publish (User $user, Event $event): bool
    {
        return $this->update($user, $event);
    }
}
