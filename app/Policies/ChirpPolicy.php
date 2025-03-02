<?php

namespace App\Policies;

use App\Models\Chirp;
use App\Models\User;

class ChirpPolicy
{
    /**
     * Determine whether the user can view a list of models.
     */
    public function viewAny(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create the model.
     */
    public function create(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chirp $chirp): bool
    {
        return $chirp->creator->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chirp $chirp): bool
    {
        return $chirp->creator->is($user);
    }
}
