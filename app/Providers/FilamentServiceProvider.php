<?php namespace App\Providers;

use App\Filament\Widgets\TotalUsers;
use App\Filament\Widgets\TotalProjects;
use Illuminate\Support\ServiceProvider;
use App\Filament\Widgets\ActiveProjects;
use App\Filament\Widgets\ExceptionGrowth;
use App\Filament\Widgets\TotalExceptions;

class FilamentServiceProvider extends ServiceProvider
{
    protected $widgets = [
        TotalExceptions::class,
        TotalUsers::class,
        TotalProjects::class,
        ActiveProjects::class,
        ExceptionGrowth::class,
    ];
}
