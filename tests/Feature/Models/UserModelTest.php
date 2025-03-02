<?php

use App\Models\User;

it('has User attributes', function () {

    // arrange
    $user = User::factory()
        ->create()
        ->fresh();

    // assert
    expect($user)->toHaveAttributes([
        'name' => $user->name,
        'email' => $user->email,
        'email_verified_at' => $user->email_verified_at,
        'created_at' => $user->created_at,
    ]);
});
