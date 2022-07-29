<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Telegram\Bot\Api;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Api::class, function ($app) {
            return new Api(config('services.telegram.token'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('DEBUG_BAR')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

        if (env('IDE_HELPER')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        Filament::serving(function () {
            Filament::registerTheme(mix('css/admin.css'));
        });
    }
}
