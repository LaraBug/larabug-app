<?php

namespace LaraBug\NovaNewsletter;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use LaraBug\NovaNewsletter\Http\Middleware\Authorize;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-newsletter');

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::script('nova-newsletter', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-newsletter', __DIR__.'/../dist/css/tool.css');

//        Nova::serving(function (ServingNova $event) {

//        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/nova-newsletter')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
