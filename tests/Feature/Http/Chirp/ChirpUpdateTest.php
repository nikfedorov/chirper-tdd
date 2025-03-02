<?php

use App\Models\Chirp;
use App\Models\User;

it('updates a chirp', function () {

    // arrange
    $chirp = Chirp::factory()->past()->create();
    $user = $chirp->creator;
    $updateChirp = Chirp::factory()->make();

    // act
    $response = $this->withoutExceptionHandling()
        ->actingAs($user)
        ->put(route('chirps.update', $chirp), [
            'message' => $updateChirp->message,
        ]);

    // assert
    $response->assertRedirect(route('chirps.index'));

    expect($user->chirps)
        ->count()->toBe(1)
        ->first()->toHaveAttributes([
            'message' => $updateChirp->message,
        ]);
});

it('cant update a chirp acting as non-creator', function () {

    // arrange
    $chirp = Chirp::factory()->create();
    $user = User::factory()->create();

    // act
    $response = $this
        ->actingAs($user)
        ->put(route('chirps.update', $chirp), [
            'message' => 'some message',
        ]);

    // assert
    $response->assertForbidden();
});
