<?php

use App\Models\Chirp;
use App\Models\User;
use App\Notifications\ChirpCreated;
use Illuminate\Support\Facades\Notification;

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

it('sends notifications to other users', function () {

    // mock
    Notification::fake();

    // arrange
    $creator = User::factory()->create();
    $user = User::factory()->create();

    // act
    $chirp = Chirp::factory()
        ->for($creator, 'creator')
        ->create();

    // assert
    Notification::assertSentTo($user, ChirpCreated::class);
    Notification::assertNotSentTo($chirp->creator, ChirpCreated::class);
});
