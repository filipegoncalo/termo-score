<?php

use App\Jobs\CheckDailyScoreJob;
use App\Models\DailyScore;
use App\Models\WordOfDay;

it('should calculate the correct points', function ($gameScore, $expectedPoinsts) {
    $dailyScore = DailyScore::factory()->create(['game_id' => 1, 'score' => $gameScore]);
    $word = WordOfDay::factory()->create(['word' => 'score', 'game_id' => 1]);

    CheckDailyScoreJob::dispatchSync($word, $dailyScore);

    expect($dailyScore->refresh())
        ->points->toBe($expectedPoinsts)
        ->status->toBe(DailyScore::STATUS_FINISHED);

})->with([
    '10 points'  => ['1/6', 10],
    '5 points'   => ['2/6', 5],
    '4 points'   => ['3/6', 4],
    '2 points'   => ['4/6', 2],
    '1 point'    => ['5/6', 1],
    '0 points'   => ['6/6', 0],
    'not enough' => ['X/6', -1],
]);
