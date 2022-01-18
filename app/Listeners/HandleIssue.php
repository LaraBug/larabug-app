<?php namespace App\Listeners;

use App\Models\Issue;
use App\Utilities\GithubIssues;
use App\Events\CreateOrUpdateIssue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleIssue implements ShouldQueue
{
    public function handle(CreateOrUpdateIssue $event)
    {
        $exception = $event->exception;
        $project = $exception->project;
        $context = 'update';

        // Get issue for exception in project
        $issue = $project->issues()
            ->where('exception', $event->exception->exception)
            ->first();

        // Create new issue if not already exists
        if (!$issue) {
            $issue = Issue::create([
                'exception' => $exception->exception,
                'project_id' => $project->id,
            ]);

            $context = 'create';
        }

        // Link the exception to the issue
        $exception->issue_id = $issue->id;
        $exception->save();

        //
        if ($context === 'create') {
            $this->sendToGithub($issue);
        }

        // Update last error at
        $issue->last_error_at = \Carbon\Carbon::now();

        $issue->save();
    }

    public function sendToGithub($issue): void
    {
        $project = $issue->project;
        $exception = $issue->exceptions->first();

        if ($project->report_to_github_issues) {
            $ghIssues = GithubIssues::make(auth()->user(), $project->github_repo);

            $larabugUrl = url('/panel/issues/' . $issue->id);

            $body = '## Stacktrace' . PHP_EOL;
            $body.= "```bash" . PHP_EOL;
            $body.= $exception->error . PHP_EOL;
            $body.= '```' . PHP_EOL;
            $body.= '---' . PHP_EOL;
            $body.= "[View on LaraBug]({$larabugUrl})" . PHP_EOL;

            $response = $ghIssues->create($exception->exception, $body);

            //
            $issue->github_issue_id = $response['id'];
            $issue->github_issue_url = $response['html_url'];

            $issue->save();
        }
    }
}