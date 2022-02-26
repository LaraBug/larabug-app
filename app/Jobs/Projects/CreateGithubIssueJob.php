<?php

namespace App\Jobs\Projects;

use App\Models\Issue;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateGithubIssueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Issue $issue;

    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
    }

    public function handle()
    {
        $user = $this->issue->project->users()->first();
        $repo = $this->issue->project->github_repo_id;

        $body = $this->getBody();

        $response = Http::github($user->github_token)->post("repositories/{$repo}/issues", [
            'title' => $this->issue->exception,
            'body' => $body,
        ]);

        $data = $response->json();

        $this->issue->github_issue_id = $data['id'];
        $this->issue->github_issue_url = $data['html_url'];

        $this->issue->saveQuietly();
    }

    public function getBody()
    {
        $larabugUrl = url('/panel/issues/' . $this->issue->id);

        $body = "# {$this->issue->exception}" . PHP_EOL;
        $body.= '## Exception' . PHP_EOL;
        $body.= "```php" . PHP_EOL;
        $body.= $this->issue->first_exception->executor_output . PHP_EOL;
        $body.= '```' . PHP_EOL;
        $body.= '---' . PHP_EOL;
        $body.= "[View on LaraBug]({$larabugUrl})" . PHP_EOL;

        return $body;
    }
}