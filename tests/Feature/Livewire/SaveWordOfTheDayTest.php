<?php

use App\Events\WordOfDayCreatedEvent;
use App\Http\Livewire\SaveWordOfTheDay;
use App\Jobs\CheckDailyScoreJob;
use App\Models\DailyScore;
use App\Models\User;
use App\Models\WordOfDay;
use Illuminate\Notifications\Action; 
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('should be able to save word of the day', function () {
    livewire(SaveWordOfTheDay::class)
        ->set('word', 'teste')
        ->set('word_confirmation', 'teste')
        ->set('game_id', 555)
        ->call('save')
        ->assertHasNoErrors();
});

test('word should be required', function () {
    livewire(SaveWordOfTheDay::class)
        ->call('save')
        ->assertHasErrors(['word' => 'required']);
});

test('word should have 5 letters', function () {
    livewire(SaveWordOfTheDay::class)
        ->set('word', 'test')
        ->set('word_confirmation', 'teste')
        ->call('save')
        ->assertHasErrors(['word' => 'size']);
});

test('game_id should be required', function () {
    livewire(SaveWordOfTheDay::class)
        ->call('save')
        ->assertHasErrors(['game_id' => 'required']);
});

test('game_id should be unique', function () {
    WordOfDay::factory()->create(['game_id' => 555]);

    livewire(SaveWordOfTheDay::class)
        ->set('game_id', 555)
        ->call('save')
        ->assertHasErrors(['game_id' => 'unique']);
});

it('should dispatch an event WordOfDayCreated', function () {
    Event::fake();

    livewire(SaveWordOfTheDay::class)
        ->set('word', 'teste')
        ->set('word_confirmation', 'teste')
        ->set('game_id', 555)
        ->call('save');

    Event::assertDispatched(WordOfDayCreatedEvent::class);
});

it('should create jobs for each daily score not computed after creating a new WordOfDay', function () {
    Bus::fake();

    DailyScore::factory()->create(['game_id' => 555, 'status' => 'computed']);
    $score = DailyScore::factory()->create(['game_id' => 555, 'status' => 'pending']);

    livewire(SaveWordOfTheDay::class)
        ->set('word', 'teste')
        ->set('word_confirmation', 'teste')
        ->set('game_id', 555)
        ->call('save');

    Bus::assertDispatched(CheckDailyScoreJob::class, function ($job) use ($score) {
        return $job->wordOfDay->word === 'teste' && $job->dailyScore->is($score);
    });
    Bus::assertDispatchedTimes(CheckDailyScoreJob::class, 1);
});

it('should be possible to create a word of the only if the user is an admin', function () {
    $user = User::factory()->admin()->create();

    actingAs($user);

    livewire(SaveWordOfTheDay::class)
        ->assertSuccessful();
        
    $nonAdmin = User::factory()->createOne();

    actingAs($nonAdmin);

    livewire(SaveWordOfTheDay::class)
        ->assertForbidden(); 
});