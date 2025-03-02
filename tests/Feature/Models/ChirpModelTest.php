<?php

use App\Models\Chirp;

it('has Chirp attributes', function () {

    // arrange
    $chirp = Chirp::factory()
        ->create()
        ->fresh();

    // assert
    expect($chirp)->toHaveAttributes([
        'message' => $chirp->message,
        'created_at' => $chirp->created_at,
        'updated_at' => $chirp->updated_at,
    ]);
});
