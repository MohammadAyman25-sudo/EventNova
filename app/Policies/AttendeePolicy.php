<?php

namespace App\Policies;

use App\Models\Attendee;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AttendeePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super-admin') || $user->hasRole('organizer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Attendee $attendee): bool
    {
        if ($user->hasRole('super-admin'))
        {
            return true;
        }
        if ($user->id === $attendee->order->user_id)
        {
            return true;
        }
        if ($user->hasRole('organizer') && $user->id === $attendee->order->event->organizer_id)
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Attendee $attendee): bool
    {
        return $user->hasRole('super-admin') ||
               ($user->hasRole('organizer') && $user->id === $attendee->order->event->organizer_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Attendee $attendee): bool
    {
        return $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Attendee $attendee): bool
    {
        return $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Attendee $attendee): bool
    {
        return $user->hasRole('super-admin');
    }
}
