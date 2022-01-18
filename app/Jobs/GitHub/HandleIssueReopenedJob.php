<?php

namespace App\Jobs\GitHub;

use App\Models\Issue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\GitHubWebhooks\Models\GitHubWebhookCall;

class HandleIssueReopenedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public GitHubWebhookCall $webhookCall;

    public function __construct(GitHubWebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        //
        $issue = Issue::firstWhere('github_issue_url', $this->webhookCall->payload('issue')['html_url']);

        if (!$issue) {
            return;
        }

        $issue->update([
            'status' => Issue::OPEN,
        ]);
    }
}