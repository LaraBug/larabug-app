<?php

namespace App\Listeners\Project;

use App\Utilities\GithubIssues;
use App\Events\Project\ProjectSavedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectSavedListener implements ShouldQueue
{
    public function handle(ProjectSavedEvent $event)
    {
        $project = $event->project;

        if ($project->report_to_github_issues && !$project->custom_webhook_enabled) {
            // Setup new webhook
            $ghIssues = new GithubIssues(auth()->user(), $project->github_repo);
            $ghIssues->createWebhook();

            //
            $project->github_webhook_status = true;
            $project->saveQuietly();
        }
    }
}