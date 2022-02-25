<?php

namespace App\Observers;

use App\Jobs\Projects\CheckGithubWebhookJob;
use App\Models\Project;

class ProjectObserver
{
    public function saved(Project $project)
    {
        CheckGithubWebhookJob::dispatchIf($project->github_issues_enabled, $project);
    }

    public function deleted()
    {
        // Remove the LaraBug if a GitHub repo is linked webhook
    }
}