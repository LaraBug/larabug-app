<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class RotateExceptions extends Command
{
    protected $signature = 'rotate:exceptions';

    protected $description = 'Rotates all the exceptions that are expired';

    protected $starterRetention = 30;

    public function handle()
    {
        $users = User::query()
            ->whereHas('projects', function ($query) {
                return $query->whereHas('exceptions', function ($query) {
                    return $query->where('created_at', '<', now()->subDays($this->starterRetention));
                });
            })
            ->with(['projects' => function ($query) {
                return $query
                    ->whereHas('exceptions', function ($query) {
                        return $query->where('created_at', '<', now()->subDays($this->starterRetention));
                    });
            }])
            ->get();

        foreach ($users as $user) {
            foreach ($user->projects as $project) {
                $project->exceptions()->where('created_at', '<', now()->subDays($this->starterRetention))->delete();
            }
        }
    }
}
