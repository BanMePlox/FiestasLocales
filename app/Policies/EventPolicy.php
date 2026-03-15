<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Cualquier usuario autenticado puede proponer un evento.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * El admin puede editar cualquier evento.
     * El autor puede editar su propuesta mientras no esté aprobada.
     */
    public function update(User $user, Event $event): bool
    {
        if ($user->is_admin) {
            return true;
        }

        return $event->submitted_by === $user->id && !$event->isApproved();
    }

    /**
     * Solo el admin puede eliminar eventos.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->is_admin;
    }

    /**
     * Solo el admin puede aprobar eventos.
     */
    public function approve(User $user, Event $event): bool
    {
        return $user->is_admin;
    }
}
