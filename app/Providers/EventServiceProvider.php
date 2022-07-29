<?php

namespace App\Providers;

use App\Listeners\UpdateLoginData;
use App\Events\ExceptionWasCreated;
use App\Listeners\UpdateStatistics;
use App\Models\Exception;
use App\Models\Issue;
use App\Observers\ExceptionObserver;
use App\Observers\IssueObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
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
        ],

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Issue::observe(IssueObserver::class);
        Exception::observe(ExceptionObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
