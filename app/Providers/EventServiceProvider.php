<?php

namespace App\Providers;

use App\Events\CreateOrUpdateIssue;
use App\Listeners\HandleIssue;
use App\Listeners\UpdateLoginData;
use App\Events\ExceptionWasCreated;
use App\Listeners\UpdateStatistics;
use Illuminate\Support\Facades\Event;
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

        CreateOrUpdateIssue::class => [
            HandleIssue::class,
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

        //
    }
}
