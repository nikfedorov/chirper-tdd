<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

pest()->use(RefreshDatabase::class);

it('has User attributes', function () {

    // arrange
    $user = User::factory()->create();

    // assert
    expect($user)->name->toBe($user->name);
});
