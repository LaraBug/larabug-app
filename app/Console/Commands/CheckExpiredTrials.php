<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\User\TrialExpiredEmail;

class CheckExpiredTrials extends Command
{
    protected $signature = 'users:trial';

    protected $description = 'Command description';

    public function handle()
    {
        $users = User::whereNotNull('trial_ends_at')
            ->where('trial_ends_at', '<', now()->subDays(5))
            ->get();

        foreach ($users as $user) {
            $user->trial_ends_at = null;
            $user->save();

            \Mail::to($user)->send(new TrialExpiredEmail($user));
        }
    }
}
