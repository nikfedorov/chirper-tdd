<?php

use App\Models\Chirp;
use App\Models\User;

it('deletes a chirp', function () {

    // arrange
    $chirp = Chirp::factory()->past()->create();
    $user = $chirp->creator;

    // act
    $response = $this->withoutExceptionHandling()
        ->actingAs($user)
        ->delete(route('chirps.destroy', $chirp));

    // assert
    $response->assertRedirect(route('chirps.index'));

    expect($user->chirps)
        ->count()->toBe(0);
});

it('cant delete a chirp acting as non-creator', function () {

    // arrange
    $chirp = Chirp::factory()->create();
    $user = User::factory()->create();

    // act
    $response = $this
        ->actingAs($user)
        ->delete(route('chirps.destroy', $chirp));

    // assert
    $response->assertForbidden();
});
