<?php

use App\Models\Chirp;
use App\Models\User;

it('returns a list of chirps', function () {

    // arrange
    $user = User::factory()->create();
    $chirps = Chirp::factory()
        ->times(2)
        ->create();

    // act
    $response = $this->withoutExceptionHandling()
        ->actingAs($user)
        ->get(route('chirps.index'));

    // assert
    $response
        ->assertOk()
        ->assertViewHas('chirps', function ($viewChirps) use ($chirps) {
            return $viewChirps->diff($chirps)->count() === 0;
        })
        ->assertSee($chirps->first()->message);
});
