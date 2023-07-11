<?php

use App\Http\Livewire\LogDailyScore;
use App\Models\DailyScore;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

it('should be able to save the daily score and track the id of the game', function ($score, $expectGameId, $expectScore, $expectDetail){

    livewire(LogDailyScore::class)
        ->set('score', $score)
        ->call('save');

    $score = DailyScore::query()->first();

    expect($score)
        ->game_id->toBe($expectGameId)
        ->score->toBe($expectScore)
        ->detail->toBe($expectDetail);
})->with([
    '1.6' => ['joguei term.ooo #555 1/6 🔥 1'.PHP_EOL.PHP_EOL.'🟩🟩🟩🟩🟩', '#555', '1/6', '🟩🟩🟩🟩🟩'],
    '2.6' => ['joguei term.ooo #555 2/6 🔥 1'.PHP_EOL.PHP_EOL.'🟨🟩🟩⬛⬛'.PHP_EOL.'🟩🟩🟩🟩🟩', '#555', '2/6', '🟨🟩🟩⬛⬛'.PHP_EOL.'🟩🟩🟩🟩🟩'],
    '3.6' => ['joguei term.ooo #555 3/6 🔥 1'.PHP_EOL.PHP_EOL.'🟨🟩🟩⬛⬛'.PHP_EOL.'⬛🟩🟩⬛🟩'.PHP_EOL.'🟩🟩🟩🟩🟩', '#555', '3/6', '🟨🟩🟩⬛⬛'.PHP_EOL.'⬛🟩🟩⬛🟩'.PHP_EOL.'🟩🟩🟩🟩🟩'],
    '4.6' => ['joguei term.ooo #555 4/6 🔥 1'.PHP_EOL.PHP_EOL.'🟨🟩🟩⬛⬛'.PHP_EOL.'⬛🟩🟩⬛🟩'.PHP_EOL.'🟩🟩🟩⬛🟩'.PHP_EOL.'🟩🟩🟩🟩🟩', '#555', '4/6', '🟨🟩🟩⬛⬛'.PHP_EOL.'⬛🟩🟩⬛🟩'.PHP_EOL.'🟩🟩🟩⬛🟩'.PHP_EOL.'🟩🟩🟩🟩🟩'],
    '5.6' => ['joguei term.ooo #555 5/6 🔥 1'.PHP_EOL.PHP_EOL.'⬛⬛🟨🟨⬛' . PHP_EOL . '🟨🟨⬛🟨⬛' . PHP_EOL . '🟨🟩⬛⬛🟩' . PHP_EOL . '⬛🟩🟩🟨🟩' . PHP_EOL . '🟩🟩🟩🟩🟩', '#555', '5/6', '⬛⬛🟨🟨⬛' . PHP_EOL . '🟨🟨⬛🟨⬛' . PHP_EOL . '🟨🟩⬛⬛🟩' . PHP_EOL . '⬛🟩🟩🟨🟩' . PHP_EOL . '🟩🟩🟩🟩🟩'],
    '6.6' => ['joguei term.ooo #555 6/6 🔥 1'.PHP_EOL.PHP_EOL.'⬛⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '🟩🟩🟩🟩🟩', '#555', '6/6', '⬛⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '🟩🟩🟩🟩🟩'],
    'x.6' => ['joguei term.ooo #555 x/6 🔥 1'.PHP_EOL.PHP_EOL.'🟨⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟨🟩⬛' . PHP_EOL . '🟨🟩⬛🟩⬛' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩', '#555', 'x/6', '🟨⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟨🟩⬛' . PHP_EOL . '🟨🟩⬛🟩⬛' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩'],
]);