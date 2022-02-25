<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class IssuesController extends Controller
{
    public function index()
    {
        $issues = auth()->user()->issues()
            ->filter(request()->only('search'))
            ->latest('last_exception_at')
            ->paginate();

        return inertia('Issues/Index', [
            'filters' => request()->only('search'),
            'issues' => $issues,
        ]);
    }

    public function show(Request $request, $id)
    {
        $issue = Issue::find($id);

        abort_unless($issue->project->user->is(auth()->user()), 403);

        $exception = $issue->exceptions()
            ->orderBy('created_at', 'DESC')
            ->first();

        $exceptions = $issue->exceptions()
            ->filter($request->only('search', 'status', 'has_feedback'))
            ->withCount('feedback')
            ->latest()
            ->paginate(10);

        return inertia('Issues/Show', [
            'issue' => $issue,
            'exception' => $exception,
            'exceptions' => $exceptions,
            'project' => $issue->project,
        ]);
    }
}