<?php

use Illuminate\Support\Facades\Event;

it('seeds the database', function () {

    // mock
    Event::fake();

    // act
    $this->artisan('db:seed');

    // assert
    expect(\App\Models\User::count())->toBe(10);
    expect(\App\Models\Chirp::count())->toBe(20);

    Event::assertNothingDispatched();
});
