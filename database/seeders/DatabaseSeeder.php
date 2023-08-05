<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DailyScore;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->admin()->create([
            'name'  => 'Filipe Gonçalo',
            'email' => 'filipe@email.com',
        ]);

        User::factory()->create([
            'name'  => 'Jessica Canuto',
            'email' => 'jessica@email.com',
        ]);

        // DailyScore::factory()->for($filipe, 'user')->count(20)->create();
        // DailyScore::factory()->for($jess, 'user')->count(20)->create();
    }
}
