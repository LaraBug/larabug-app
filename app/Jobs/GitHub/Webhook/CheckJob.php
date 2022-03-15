<?php

namespace App\Jobs\GitHub\Webhook;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use function collect;

class CheckJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Project $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function handle()
    {
        $user = $this->project->users()->first();

        $repo = $this->project->github_repo_id;

        //
        $response = Http::github($user->github_token)->get("repositories/{$repo}/hooks");

        if (!$response->ok()) {
            return;
        }

        $isPresent = collect($response->json())
            ->pluck('config.url')
            ->contains('https://larabug.share.codecycler.dev/github-webhook');

        if ($isPresent) {
            return;
        }

        $response = Http::github($user->github_token)->post("repositories/{$repo}/hooks", [
            'config' => [
                'url' => 'https://larabug.share.codecycler.dev/github-webhook',
                'content_type' => 'json',
                'secret' => '1234567890',
                'insecure_ssl' => '1',
            ],
            'events' => ['issues', 'issue_comment', 'pull_request', 'commit_comment', 'push', 'release', 'create', 'delete'],
        ])->json();

        if (!isset($response['id'])) {
            return false;
        }

        $this->project->github_webhook_id = $response['id'];
        $this->project->saveQuietly();
    }
}