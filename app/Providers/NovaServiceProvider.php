<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\NewProjects;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\ProjectsPerDay;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Actions\ActionEvent;
use LaraBug\NovaNewsletter\NovaNewsletter;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        ActionEvent::saving(function ($actionEvent) {
            if (in_array($actionEvent->name, ['Create', 'Update', 'Save'])) {
                return false;
            }
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return $user->isAdmin();
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            (new UsersPerDay)->width('2/3'),
            new NewUsers,
            (new ProjectsPerDay)->width('2/3'),
            new NewProjects
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new NovaNewsletter,
        ];
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
