<?php namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class IssuesController extends Controller
{
    public function index()
    {
        $projectIds = auth()->user()
            ->projects
            ->pluck('id')
            ->toArray();

        $issues = Issue::whereIn('project_id', $projectIds)
            ->filter(request()->only('search'))
            ->latest('last_error_at')
            ->paginate();

        return inertia('Issues/Index', [
            'filters' => request()->only('search'),
            'issues' => $issues,
        ]);
    }

    public function show(Request $request, $id)
    {
        $projectIds = auth()->user()
            ->projects
            ->pluck('id')
            ->toArray();

        $issue = Issue::find($id);

        if (!in_array($issue->project_id, $projectIds)) {
            // TODO: Create 403 exception
            return;
        }

        // Get the last exception
        $exception = $issue->exceptions()
            ->orderBy('created_at', 'DESC')
            ->first();

        $exceptions = $issue
            ->exceptions()
            ->filter($request->only('search', 'status', 'has_feedback'))
            ->withCount('feedback')
            ->latest()
            ->paginate(10);

        return inertia('Issues/Show', [
            'issue' => $issue,
            'events' => $issue->events()->orderBy('created_at', 'desc')->get(),
            'exception' => $exception,
            'exceptions' => $exceptions,
            'project' => $issue->project,
        ]);
    }
}