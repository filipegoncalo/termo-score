<?php

namespace App\Jobs;

use App\Models\DailyScore;
use App\Models\WordOfDay;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckDailyScoreJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public WordOfDay $wordOfDay, public DailyScore $dailyScore)
    {   
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
