<?php

namespace Database\Seeders;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChirpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()
            ->get()
            ->each(fn ($user) => Chirp::factory()
                ->times(2)
                ->for($user, 'creator')
                ->past()
                ->create()
            );
    }
}
