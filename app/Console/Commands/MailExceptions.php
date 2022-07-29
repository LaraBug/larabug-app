<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Exception;
use App\Mail\ExceptionEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MailExceptions extends Command
{
    protected $signature = 'mail:exceptions';

    protected $description = 'Command description';

    public function handle()
    {
        $users = User::query()->where('receive_email', true)
            ->whereHas('projects', function ($query) {
                return $query
                    ->where('notifications_enabled', true)
                    ->where('receive_email', true)
                    ->whereHas('exceptions', function ($query) {
                        return $query->where('mailed', false);
                    });
            })
            ->with(['projects' => function ($query) {
                return $query
                    ->select('id', 'title')
                    ->where('notifications_enabled', true)
                    ->where('receive_email', true)
                    ->whereHas('exceptions', function ($query) {
                        return $query->where('mailed', false);
                    })
                    ->with(['exceptions' => function ($query) {
                        return $query
                            ->select('id', 'exception', 'mailed', 'created_at', 'project_id')
                            ->where('mailed', false);
                    }]);
            }])
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->name,
                    'email' => $user->email,

                    'projects' => $user->projects->map(function ($project) {
                        return [
                            'id' => $project->id,
                            'title' => $project->title,
                            'exceptions' => $project->exceptions->map(function (Exception $exception) {
                                if (!$exception->mailed) {
                                    $exception->markAsMailed();
                                }

                                return [
                                    'id' => $exception->id,
                                    'exception' => $exception->exception,
                                    'project_id' => $exception->project_id,
                                    'created_at' => $exception->created_at,
                                ];
                            })
                        ];
                    })
                ];
            });

        foreach ($users as $user) {
            Mail::send(new ExceptionEmail($user));
        }
    }
}
