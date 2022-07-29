<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use App\Models\Exception;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverviewWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            BaseWidget\Card::make('Active projects', $this->getActiveProjects())
                ->description('has exceptions in the last 30 days'),
            BaseWidget\Card::make('Last 30 days growth', $this->getExceptionGrowth())
                ->description('compared to the 30 days before'),
            BaseWidget\Card::make('Total exceptions', $this->getTotalExceptions()),
            BaseWidget\Card::make('Total projects', $this->getTotalProjects()),
            BaseWidget\Card::make('Total users', $this->getTotalUsers()),
        ];
    }

    protected function getActiveProjects(): int
    {
        $lastMonth = Carbon::now()->subMonth();

        return Project::query()->where('last_error_at', '>=', $lastMonth)->count();
    }

    protected function getExceptionGrowth(): int
    {
        $previousMonthStart = Carbon::now()->subDays(60);
        $thisMonthStart = Carbon::now()->subDays(30);

        $previousMonth = Exception::query()
            ->where('created_at', '>=', $previousMonthStart)
            ->where('created_at', '<=', $thisMonthStart)
            ->count();

        $thisMonth = Exception::query()
            ->where('created_at', '>=', $thisMonthStart)
            ->count();

        if ($previousMonth === 0) {
            $growth = 0;
        } else {
            $growth = round(($thisMonth - $previousMonth) / $previousMonth * 100);
        }

        return $growth;
    }

    protected function getTotalExceptions(): int
    {
        return Exception::query()->count();
    }

    protected function getTotalProjects(): int
    {
        return Project::query()->count();
    }

    protected function getTotalUsers(): int
    {
        return User::query()->count();
    }
}
