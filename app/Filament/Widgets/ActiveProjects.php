<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\Widget;

class ActiveProjects extends Widget
{
    public static $view = 'filament.widgets.active-projects';

    public function render()
    {
        $lastMonth = now()->subMonth();

        $count = Project::where('last_error_at', '>=', $lastMonth)->count();

        return view(static::$view, [
            'count' => $count,
        ]);
    }
}
