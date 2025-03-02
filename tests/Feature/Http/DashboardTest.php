<?php

use App\Models\User;

it('shows the dashboard', function () {

    // arrange
    $user = User::factory()->create();

    // act
    $response = $this->withoutExceptionHandling()
        ->actingAs($user)
        ->get(route('dashboard'));

    // assert
    $response
        ->assertOk()
        ->assertSeeInOrder([
            route('chirps.index'),
            route('chirps.index'),
        ]);
});
