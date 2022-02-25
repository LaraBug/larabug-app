<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Http::macro('github', function ($token = null) {
            if (!$token) {
                $token = auth()->user()->github_token;
            }

            return Http::withHeaders([
                'Authorization' => "token {$token}",
            ])->baseUrl('https://api.github.com');
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
    }
}
