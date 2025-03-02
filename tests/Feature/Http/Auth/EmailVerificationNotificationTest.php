<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;

beforeEach(function () {
    Notification::fake();
});

test('user can receive email verification notification', function () {
    $user = User::factory()->unverified()->create();

    $response = $this->actingAs($user)->post(route('verification.send'));

    Notification::assertSentTo($user, VerifyEmail::class);
    $response->assertRedirect();
});

test('verified user cant receive email verification notification', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('verification.send'));

    Notification::assertNotSentTo($user, VerifyEmail::class);
    $response->assertRedirect();
});
