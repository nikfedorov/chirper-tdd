<?php

use App\Models\Chirp;
use App\Models\User;

it('stores a chirp', function () {

    // arrange
    $user = User::factory()->create();
    $chirp = Chirp::factory()->make();

    // act
    $response = $this->withoutExceptionHandling()
        ->actingAs($user)
        ->post(route('chirps.store'), [
            'message' => $chirp->message,
        ]);

    // assert
    $response->assertRedirect(route('chirps.index'));
    expect($user->chirps())
        ->count()->toBe(1)
        ->first()->toHaveAttributes([
            'message' => $chirp->message,
        ]);
});
