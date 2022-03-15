<?php

namespace App\Jobs\GitHub\Issue;

use App\Models\Issue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class OpenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Issue $issue)
    {
    }

    public function handle()
    {
        $user = $this->issue->project->users()->first();
        $repo = $this->issue->project->github_repo_id;

        $response = Http::github($user->github_token)
            ->patch("repositories/{$repo}/issues/{$this->issue->github_issue_number}", [
                'state' => 'open',
            ]);

        ray($response);
    }
}