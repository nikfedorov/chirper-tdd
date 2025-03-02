<?php

use App\Models\Chirp;
use App\Models\User;

it('shows a chirp edit form', function () {

    // arrange
    $chirp = Chirp::factory()->create();

    // act
    $response = $this->withoutExceptionHandling()
        ->actingAs($chirp->creator)
        ->get(route('chirps.edit', $chirp));

    // assert
    $response
        ->assertOk()
        ->assertViewHas('chirp', $chirp)
        ->assertSee('<form method="POST" action="'.route('chirps.update', $chirp).'"', false);
});

it('doesnt show edit form to non-creator', function () {

    // arrange
    $user = User::factory()->create();
    $chirp = Chirp::factory()->create();

    // act
    $response = $this
        ->actingAs($user)
        ->get(route('chirps.edit', $chirp));

    // assert
    $response->assertForbidden();
});
