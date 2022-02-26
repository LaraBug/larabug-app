<?php

namespace App\Jobs\Projects;

use App\Models\Issue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessGithubWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $event;

    public array $payload;

    public function __construct(string $event, array $payload)
    {
        $this->event = $event;
        $this->payload = $payload;
    }

    public function handle()
    {
        if ($this->event === 'issues' && $this->payload['action'] === 'closed') {
            // Find issue and close it
            $this->updateIssueStatus('closed');
        }

        if ($this->event === 'issues' && $this->payload['action'] === 'reopened') {
            $this->updateIssueStatus('open');
        }
    }

    protected function updateIssueStatus(string $status): void
    {
        $issue = Issue::firstWhere('github_issue_id', $this->payload['issue']['id']);

        if ($issue) {
            $issue->status = $status;
            $issue->saveQuietly();
        }
    }
}