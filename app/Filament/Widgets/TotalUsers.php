<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;

class TotalUsers extends Widget
{
    public static $view = 'filament.widgets.total-users';

    public function render()
    {
        $count = User::count();

        return view(static::$view, [
            'count' => $count,
        ]);
    }
}
