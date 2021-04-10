<?php

namespace App\Listeners;

use App\Models\Statistic;
use App\Events\ExceptionWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateStatistics implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  ExceptionWasCreated  $event
     * @return void
     */
    public function handle(ExceptionWasCreated $event)
    {
        $statistics = Statistic::firstOrCreate([
            'total_exceptions' => 0
       ]);

        $statistics->total_exceptions ++;
        $statistics->save();
    }
}
