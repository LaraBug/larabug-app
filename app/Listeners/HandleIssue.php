<?php namespace App\Listeners;

use App\Models\Issue;
use App\Events\CreateOrUpdateIssue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleIssue implements ShouldQueue
{
    public function handle(CreateOrUpdateIssue $event)
    {
        $exception = $event->exception;
        $project = $exception->project;

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
        }

        // Link the exception to the issue
        $exception->issue_id = $issue->id;
        $exception->save();

        // Update last error at
        $issue->last_error_at = \Carbon\Carbon::now();

        $issue->save();
    }
}