<?php

namespace App\Observers;

use App\Jobs\Projects\CheckGithubWebhookJob;
use App\Models\Project;
use Illuminate\Support\Facades\Http;

class ProjectObserver
{
    public function saved(Project $project)
    {
        // Set the repo ID
        if ($project->github_issues_enabled && $project->github_repo) {
            $response = Http::github($project->users()->first()->github_token)->get("repos/{$project->github_repo}");

            $data = $response->json();

            if ($data && isset($data['id'])) {
                $project->updateQuietly([
                    'github_repo_id' => $data['id'],
                ]);

                CheckGithubWebhookJob::dispatchIf($project->github_issues_enabled && $project->github_repo_id, $project);
            }
        }
    }

    public function deleted()
    {
        // Remove the LaraBug if a GitHub repo is linked webhook
    }
}