<?php

namespace App\Observers;

use App\Jobs\GitHub\Issue\CloseJob;
use App\Jobs\GitHub\Issue\CreateJob;
use App\Jobs\GitHub\Issue\OpenJob;
use App\Models\Issue;

class IssueObserver
{
    public function created(Issue $issue)
    {
        $githubEnabled = $issue->project->github_issues_enabled && $issue->project->github_webhook_id;
        CreateJob::dispatchIf($githubEnabled, $issue);
    }

    public function updated(Issue $issue)
    {
        if (!$issue->github_issue_id) {
            return false;
        }

        if ($issue->getOriginal('status') === 'open' && $issue->status === 'closed') {
            // Close issue on GitHub
            CloseJob::dispatch($issue);
        }

        if ($issue->getOriginal('status') === 'closed' && $issue->status === 'open') {
            // Open issue on GitHub
            OpenJob::dispatch($issue);
        }
    }
}