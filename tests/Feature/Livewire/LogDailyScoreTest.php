<?php

use App\Http\Livewire\LogDailyScore;
use App\Models\DailyScore;

use function Pest\Livewire\livewire;

it('should be able to save the daily score and track the id of the game', function ($score, $expectGameId, $expectScore, $expectDetail) {

    livewire(LogDailyScore::class)
        ->set('data', $score)
        ->set('word', 'termo')
        ->call('save');

    $score = DailyScore::query()->first();

    expect($score)
        ->game_id->toBe($expectGameId)
        ->score->toBe($expectScore)
        ->detail->toBe($expectDetail);
})->with([
    '1.6' => ['joguei term.ooo #555 1/6 🔥 1' . PHP_EOL . PHP_EOL . '🟩🟩🟩🟩🟩', '#555', '1/6', '🟩🟩🟩🟩🟩'],
    '2.6' => ['joguei term.ooo #555 2/6 🔥 1' . PHP_EOL . PHP_EOL . '🟨🟩🟩⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩', '#555', '2/6', '🟨🟩🟩⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩'],
    '3.6' => ['joguei term.ooo #555 3/6 🔥 1' . PHP_EOL . PHP_EOL . '🟨🟩🟩⬛⬛' . PHP_EOL . '⬛🟩🟩⬛🟩' . PHP_EOL . '🟩🟩🟩🟩🟩', '#555', '3/6', '🟨🟩🟩⬛⬛' . PHP_EOL . '⬛🟩🟩⬛🟩' . PHP_EOL . '🟩🟩🟩🟩🟩'],
    '4.6' => ['joguei term.ooo #555 4/6 🔥 1' . PHP_EOL . PHP_EOL . '🟨🟩🟩⬛⬛' . PHP_EOL . '⬛🟩🟩⬛🟩' . PHP_EOL . '🟩🟩🟩⬛🟩' . PHP_EOL . '🟩🟩🟩🟩🟩', '#555', '4/6', '🟨🟩🟩⬛⬛' . PHP_EOL . '⬛🟩🟩⬛🟩' . PHP_EOL . '🟩🟩🟩⬛🟩' . PHP_EOL . '🟩🟩🟩🟩🟩'],
    '5.6' => ['joguei term.ooo #555 5/6 🔥 1' . PHP_EOL . PHP_EOL . '⬛⬛🟨🟨⬛' . PHP_EOL . '🟨🟨⬛🟨⬛' . PHP_EOL . '🟨🟩⬛⬛🟩' . PHP_EOL . '⬛🟩🟩🟨🟩' . PHP_EOL . '🟩🟩🟩🟩🟩', '#555', '5/6', '⬛⬛🟨🟨⬛' . PHP_EOL . '🟨🟨⬛🟨⬛' . PHP_EOL . '🟨🟩⬛⬛🟩' . PHP_EOL . '⬛🟩🟩🟨🟩' . PHP_EOL . '🟩🟩🟩🟩🟩'],
    '6.6' => ['joguei term.ooo #555 6/6 🔥 1' . PHP_EOL . PHP_EOL . '⬛⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '🟩🟩🟩🟩🟩', '#555', '6/6', '⬛⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '🟩🟩🟩🟩🟩'],
    'x.6' => ['joguei term.ooo #555 x/6 🔥 1' . PHP_EOL . PHP_EOL . '🟨⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟨🟩⬛' . PHP_EOL . '🟨🟩⬛🟩⬛' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩', '#555', 'x/6', '🟨⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟨🟩⬛' . PHP_EOL . '🟨🟩⬛🟩⬛' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩'],
]);

it('should request for the word of the day', function () {
    livewire(LogDailyScore::class)
        ->call('save')
        ->assertHasErrors(['word' => 'required']);
});

it('should ask for confirmation of the word of the day', function(){
    livewire(LogDailyScore::class)
        ->set('word', 'termo')
        ->set('word_confirmation','')
        ->call('save')
        ->assertHasErrors(['word' => 'confirmed']);
});

test('if word already exist for the given game id we should  check if is valid', function(){
    WordOfDay::factory()->create(['word' => 'termo', 'game_id' => 555]);
    $data = 'joguei term.ooo #555 1/6 🔥 1' . PHP_EOL . PHP_EOL . '🟩🟩🟩🟩🟩';

    livewire(LogDailyScore::class)
        ->set('data', $data)
        ->set('word', 'paulo')
        ->call('save')
        ->assertHasErrors(['word' => WordIsValid::class]);
});