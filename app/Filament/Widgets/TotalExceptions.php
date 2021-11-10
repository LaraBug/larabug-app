<?php

namespace App\Filament\Widgets;

use App\Models\Exception;
use Filament\Widgets\Widget;

class TotalExceptions extends Widget
{
    public static $view = 'filament.widgets.total-exceptions';

    public function render()
    {
        $count = Exception::count();

        return view(static::$view, [
            'count' => $count,
        ]);
    }
}
