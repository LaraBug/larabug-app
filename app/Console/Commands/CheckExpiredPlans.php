<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\UserPlanExpired;

class CheckExpiredPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks the application for expired users and notifies these.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::expired()->get();

        $users->each(function ($user) {
            $user->notify(new UserPlanExpired);

            $user->markAsExpired();
        });
    }
}
