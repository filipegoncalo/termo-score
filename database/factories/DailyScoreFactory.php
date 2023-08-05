<?php

namespace Database\Factories;

use App\Models\DailyScore;
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
            'word'    => $this->faker->text(5),
            'status'  => 'pending'
        ];
    }

    public function withPoints()
    {
        return $this->afterMaking(function (DailyScore $dailyScore) {
            $scores = [
                '1/6'   => 10,
                '2/6'   => 5,
                '3/6'   => 4,
                '4/6'   => 2,
                '5/6'   => 1,
                '6/6'   => 0,
                'X/6'   => -1,
            ];

            $score = $this->faker->randomElement (['1/6', '2/6', '3/6', '4/6', '5/6', '6/6', 'X/6']);

            $dailyScore->points = $scores[$score];
            $dailyScore->status = DailyScore::STATUS_FINISHED;
        });
    }
}
