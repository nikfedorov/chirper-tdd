<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chirp>
 */
class ChirpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'creator_id' => User::factory(),
            'message' => fake()->catchPhrase(),
        ];
    }

    /**
     * Create Chirp in the past.
     */
    public function past(): self
    {
        $at = fake()->dateTimeBetween('-1 month');

        return $this->state([
            'created_at' => $at,
            'updated_at' => $at,
        ]);
    }

    /**
     * Create updated Chirp.
     */
    public function updated(): self
    {
        return $this->state([
            'created_at' => fake()->dateTimeBetween('-1 month'),
            'updated_at' => now(),
        ]);
    }
}
