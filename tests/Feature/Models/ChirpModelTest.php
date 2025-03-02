<?php

use App\Models\Chirp;
use App\Models\User;

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

it('belongs to User', function () {

    // arrange
    $chirp = Chirp::factory()->create()->fresh();
    $user = User::factory()->create()->fresh();

    // act
    $chirp->creator()->associate($user);
    $chirp->save();

    // assert
    expect($user->chirps())
        ->count()->toBe(1)
        ->first()->toBe($chirp);
});
