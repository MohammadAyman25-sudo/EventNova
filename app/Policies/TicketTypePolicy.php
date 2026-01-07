<?php

namespace App\Policies;

use App\Models\TicketType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TicketTypePolicy
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
    public function view(User $user, TicketType $ticketType): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, TicketType $ticketType): bool
    {
        return $user->hasRole('super-admin') ||
               $user->id === $ticketType->event->organizer_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TicketType $ticketType): bool
    {
        return $this->create($user, $ticketType);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TicketType $ticketType): bool
    {
        return $this->create($user, $ticketType);
    }
}
