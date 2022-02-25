<?php

namespace App\Providers;

use App\Models\Exception;
use App\Listeners\UpdateLoginData;
use App\Events\ExceptionWasCreated;
use App\Models\Project;
use App\Observers\ExceptionObserver;
use App\Observers\ProjectObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ExceptionWasCreated::class => [
            //UpdateStatistics::class,
        ],

        \Illuminate\Auth\Events\Login::class => [
            UpdateLoginData::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Project::observe(ProjectObserver::class);
        Exception::observe(ExceptionObserver::class);
    }
}
