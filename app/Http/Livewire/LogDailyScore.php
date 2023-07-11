<?php

namespace App\Http\Livewire;

use App\Models\DailyScore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class LogDailyScore extends Component
{
    public ?string $score = null;

    public function render(): Factory | View | Application
    {
        return view('livewire.log-daily-score');
    }

    public function save()
    {
        $gameId = '#' . str($this->score)->betweenFirst('#', ' ');
        $score = substr(str($this->score)->between(' ', ' 🔥'), -3);
        
        $exp = explode(PHP_EOL, $this->score);
        unset($exp[0]);
        unset($exp[1]);

        $detail = trim(implode(PHP_EOL, $exp));

        DailyScore::query()
            ->create([
                'game_id' => $gameId,
                'score' => $score,
                'detail' => $detail
            ]);
    }
}
