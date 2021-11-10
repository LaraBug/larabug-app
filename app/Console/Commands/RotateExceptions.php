<?php

namespace App\Console\Commands;

use App\Models\Exception;
use Illuminate\Console\Command;

class RotateExceptions extends Command
{
    protected $signature = 'rotate:exceptions';

    protected $description = 'Rotates all the exceptions that are expired';

    protected $starterRetention = 30;

    public function handle()
    {
        $rotate = Exception::query()->where('created_at', '<', now()->subDays(20))->delete();

        $this->info('Rotated ' . $rotate . ' exceptions!');
    }
}
