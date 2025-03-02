<?php

namespace App\Http\Requests\Concerns;

use App\Models\User;

trait HasUser
{
    /**
     * Get a User model instance.
     */
    public function user($guard = null): User
    {
        $user = parent::user($guard);
        if (! $user instanceof User) {
            abort(403); // @codeCoverageIgnore
        }

        return $user;
    }
}
