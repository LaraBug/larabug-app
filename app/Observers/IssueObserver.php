<?php

namespace App\Observers;

use App\Jobs\Projects\CreateGithubIssueJob;
use App\Models\Issue;

class IssueObserver
{
    public function created(Issue $issue)
    {
        $githubEnabled = $issue->project->github_issues_enabled && $issue->project->github_webhook_id;
        CreateGithubIssueJob::dispatchIf($githubEnabled, $issue);
    }
}