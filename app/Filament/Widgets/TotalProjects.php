<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\Widget;

class TotalProjects extends Widget
{
    public static $view = 'filament.widgets.total-projects';

    public function render()
    {
        $count = Project::count();

        return view(static::$view, [
            'count' => $count,
        ]);
    }
}
