<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyScore>
 */
class DailyScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'game_id' => 555,
            'score'   => '1/6',
            'detail'  => 'joguei term.ooo #555 1/6 🔥 1' . PHP_EOL . PHP_EOL . '🟩🟩🟩🟩🟩',
            'word'    => str($this->faker->word)->limit(5),
            'status'  => 'pending'
        ];
    }
}
