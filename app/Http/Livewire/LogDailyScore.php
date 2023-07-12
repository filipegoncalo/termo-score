<?php

namespace App\Http\Livewire;

use App\Models\DailyScore;
use App\Rules\DetailRule;
use App\Rules\GameIdRule;
use App\Rules\ScoreRule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class LogDailyScore extends Component
{
    public ?string $data = null;
    public ?string $gameId = null;
    public ?string $score = null;
    public ?string $detail = null;

    public function render(): Factory | View | Application
    {
        return view('livewire.log-daily-score');
    }

    public function save()
    {
         
        $this->gameId = '#' . str($this->data)->betweenFirst('#', ' ');
        $this->score = substr(str($this->data)->between(' ', ' 🔥'), -3);
        
        $exp = explode(PHP_EOL, $this->data);
        unset($exp[0]);
        unset($exp[1]);
        $exp = str(implode(PHP_EOL, $exp));
        
        $this->detail = trim($exp);

        //dd(new GameIdRule());

        $this->validate([
            'gameId' => ['required', new GameIdRule()],
            'score' => ['required', new ScoreRule()],
            'detail' => ['required', new DetailRule()]
        ]);

        DailyScore::query()
            ->create([
                'game_id' => $this->gameId,
                'score' => $this->score,
                'detail' => $this->detail
            ]);
    }
}
