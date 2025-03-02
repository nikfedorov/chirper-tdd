<?php

namespace App\Observers;

use App\Models\Chirp;
use App\Models\User;
use App\Notifications\ChirpCreated;

class ChirpObserver
{
    /**
     * Handle the Chirp "created" event.
     */
    public function created(Chirp $chirp): void
    {
        User::query()
            ->where('id', '!=', $chirp->creator_id)
            ->get()
            ->each(fn ($user) => $user->notify(new ChirpCreated($chirp)));
    }
}
