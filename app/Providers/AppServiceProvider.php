<?php

namespace App\Providers;

use App\SocialProviders\PloiProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');

        $this->bootPloiSocialite();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLengthAwarePaginator();

        if (env('DEBUG_BAR')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

        if (env('IDE_HELPER')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    private function bootPloiSocialite()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'ploi',
            function ($app) use ($socialite) {
                $config = $app['config']['services.ploi'];
                return $socialite->buildProvider(PloiProvider::class, $config);
            }
        );
    }


    protected function registerLengthAwarePaginator()
    {
    }
}
