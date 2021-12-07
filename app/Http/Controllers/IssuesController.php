<?php namespace App\Http\Controllers;

use App\Models\Issue;

class IssuesController extends Controller
{
    public function index()
    {
        $projectIds = auth()->user()->projects->pluck('id')->toArray();
        $issues = Issue::whereIn('project_id', $projectIds)
            ->filter(request()->only('search'))
            ->latest('last_error_at')
            ->paginate();

        return inertia('Issues/Index', [
            'filters' => request()->only('search'),
            'issues' => $issues,
        ]);
    }
}