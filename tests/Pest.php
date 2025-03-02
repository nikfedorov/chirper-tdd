<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class)->in('Feature');

/**
 * Add checks for toBe assertion.
 */
expect()->pipe('toBe', function (Closure $next, mixed $expected) {

    // compare against a carbon object
    if ($this->value instanceof Carbon) {
        return expect($this->value->toDateTimeString())
            ->toBe(Carbon::parse($expected)->toDateTimeString());
    }

    // compare against a model
    if ($this->value instanceof Model) {
        return expect($this->value->is($expected))
            ->toBe(true);
    }

    return $next();
});

/**
 * Check for a list of array attributes.
 */
expect()->extend('toHaveAttributes', function (array $attributes) {
    foreach ($attributes as $key => $value) {
        expect($this->value->$key)
            ->toBe($value)
            ->not->toBeNull($key);
    }
});
