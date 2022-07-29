<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Response;

class IssuesController extends Controller
{
    public function index()
    {
        $projectIds = auth()->user()->projects()->pluck('id');

        $issues = Issue::query()
            ->with('project:id,title')
            ->whereIn('project_id', $projectIds)
            ->filter(request()->only('search'))
            ->orderBy('last_occurred_at', 'desc')
            ->paginate();

        return inertia('Issues/Index', [
            'filters' => request()->only('search'),
            'issues' => $issues,
        ]);
    }

    public function show($id)
    {
        $projectIds = auth()->user()->projects()->pluck('id');

        $issue = Issue::query()->findOrFail($id);

        abort_unless($projectIds->contains($issue->project_id), Response::HTTP_FORBIDDEN);

        $exceptions = $issue
            ->exceptions()
            ->filter(request()->only('search', 'status', 'has_feedback'))
            ->withCount('feedback')
            ->latest()
            ->paginate(10);

        $affectedVersions = $issue->exceptions()
            ->pluck('project_version')
            ->unique()
            ->filter()
            ->sort()
            ->values()
            ->toArray();

        return inertia('Issues/Show', [
            'issue' => $issue,
            'exceptions' => $exceptions,
            'project' => $issue->project,
            'filters' => request()->only('search'),
            'affected_versions' => implode(', ', $affectedVersions) ?: '-',
            'last_occurrence_human' => $issue->last_occurred_at->diffForHumans(),
            'total_occurrences' => $issue->exceptions()->count(),
        ]);
    }

    public function updateStatus($id)
    {
        $projectIds = auth()->user()->projects()->pluck('id');

        $issue = Issue::query()->findOrFail($id);

        abort_unless($projectIds->contains($issue->project_id), Response::HTTP_FORBIDDEN);

        $issue->update([
            'status' => request()->input('status'),
        ]);

        return redirect()->route('panel.issues.show', $issue->id)->with('success', 'Changed issue status successfully');
    }
}
