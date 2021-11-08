<?php

namespace App\Console;

use App\Console\Commands\MailExceptions;
use App\Console\Commands\GenerateSitemap;
use App\Console\Commands\ShowConfigFiles;
use App\Console\Commands\RotateExceptions;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\RunProjectScreenshots;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        MailExceptions::class,
        RotateExceptions::class,
        ShowConfigFiles::class,
        RunProjectScreenshots::class,
        GenerateSitemap::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('rotate:exceptions')->twiceDaily();

        $schedule->command('mail:exceptions')->everyFifteenMinutes();

        $schedule->command('horizon:snapshot')->everyFiveMinutes();

        $schedule->command('sitemap:generate')->dailyAt('01:00');
    }
}
