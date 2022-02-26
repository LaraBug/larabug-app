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
        ray($this->event, $this->payload);

        if ($this->event === 'issues' && $this->payload['action'] === 'closed') {
            // Find issue and close it
            $this->updateIssueStatus('closed');
        }

        if ($this->event === 'issues' && $this->payload['action'] === 'reopened') {
            $this->updateIssueStatus('open');
        }

        if ($this->event === 'issue_comment' && $this->payload['action'] === 'created') {
            $this->createIssueComment();
        }

        if ($this->event === 'issues' && $this->payload['action'] === 'labeled') {
            $this->assignLabel();
        }

        if ($this->event === 'issues' && $this->payload['action'] === 'unlabeled') {
            $this->removeLabel();
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

    protected function createIssueComment(): void
    {
    }

    protected function assignLabel(): void
    {
        $issue = $this->getIssue();

        $labels = collect($issue->labels)->keyBy('name');

        // Check if label already exists
        if (!$labels->has($this->payload['label']['name'])) {
            $labels->push([
                'name' => $this->payload['label']['name'],
                'color' => '#' . $this->payload['label']['color'],
            ]);

            $issue->labels = $labels->values();

            $issue->saveQuietly();
        }
    }

    protected function removeLabel(): void
    {
        $issue = $this->getIssue();

        $labels = collect($issue->labels)->keyBy('name');

        if ($labels->has($this->payload['label']['name'])) {
            $labels->forget($this->payload['label']['name']);

            $issue->updateQuietly([
                'labels' => $labels->values(),
            ]);
        }
    }

    protected function getIssue()
    {
        return Issue::firstWhere('github_issue_id', $this->payload['issue']['id']);
    }
}