<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Notifications\TestWebhook;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()
            ->projects()
            ->select('id', 'title', 'total_exceptions')
            ->withCount('unreadExceptions')
            ->filter(request()->only('search'))
            ->latest('last_error_at')
            ->latest('created_at')
            ->paginate();

        return inertia('Projects/Index', [
            'filters' => request()->only('search'),
            'projects' => $projects,
        ]);
    }

    public function create()
    {
        return inertia('Projects/Create');
    }

    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->only([
            'title',
            'url',
            'description',
            'receive_email',
            'notifications_enabled',
            'slack_webhook',
            'discord_webhook',
            'custom_webhook',
            'mobile_notifications_enabled',
            'slack_webhook_enabled',
            'discord_webhook_enabled',
            'custom_webhook_enabled',
        ]));

        $request->user()->projects()->save($project, ['owner' => true]);

        return redirect()->route('panel.projects.installation', $project);
    }

    public function show(Request $request, $id)
    {
        $project = auth()->user()
            ->projects()
            ->withCount('unreadExceptions')
            ->findOrFail($id);

        $exceptions = $project
            ->exceptions()
            ->filter($request->only('search', 'status', 'has_feedback'))
            ->withCount('feedback')
            ->latest()
            ->paginate(10);

        return inertia('Projects/Show', [
            'project' => $project,
            'exceptions' => $exceptions->appends($request->except('page')),
            'filters' => request()->all('search', 'status', 'has_feedback'),
        ]);
    }

    public function edit($id)
    {
        $project = auth()->user()
            ->projects()
            ->findOrFail($id);

        if (!$project->isOwner()) {
            return redirect()->route('projects.show', $project)->withErrors([
                'You are not the main owner of this project, therefore you cannot edit the project.'
            ]);
        }

        return inertia('Projects/Edit', [
            'project' => $project
        ]);
    }

    public function update(ProjectRequest $request, $id)
    {
        $project = $request->user()
            ->projects()
            ->findOrFail($id);

        $previousUrl = $project->url;

        if (!$project->isOwner()) {
            return redirect()->route('projects.show', $project)->withErrors([
                'You are not the main owner of this project, therefore you cannot edit the project.'
            ]);
        }

        $project->update($request->except('group_id'));

        /*
         * Attach group if the id is not the same
         */
        if ($project->group_id != $request->input('group_id')) {
            $this->attachGroup($request, $project);
        }

        if ($previousUrl != $project->url) {
            //dispatch(new GetSiteScreenshot($project));
        }

        return redirect()->route('panel.projects.show', $project)->with('success', 'Project has been updated');
    }

    public function destroy(Request $request, $id)
    {
        $project = $request->user()
            ->projects()
            ->findOrFail($id);

        if (!$project->isOwner()) {
            return redirect()->route('projects.show', $project)->withErrors([
                'You are not the main owner of this project, therefore you cannot edit the project.'
            ]);
        }

        $project->delete();

        return redirect()->route('panel.projects.index')->with('success', 'Project has been removed');
    }

    public function installation($id)
    {
        $project = auth()->user()
            ->projects()
            ->findOrFail($id);

        return inertia('Projects/Installation', [
            'project' => $project
        ]);
    }

    public function feedbackInstallation($id)
    {
        $project = auth()->user()
            ->projects()
            ->findOrFail($id);

        return inertia('Projects/FeedbackInstallation', [
            'project' => $project
        ]);
    }

    public function testWebhook(Request $request, $id)
    {
        $project = auth()->user()
            ->projects()
            ->findOrFail($id);

        $project->notify(new TestWebhook($project, $request->input('type', 'slack')));

        return redirect()->route('projects.show', $project)->withSuccess('Test notification has been send!');
    }

    protected function attachGroup(Request $request, Project $project)
    {
        if (!$request->user()->canManageGroups()) {
            return;
        }

        $group = $request->user()->projectGroups()->find($request->input('group_id'));

        /*
         * If no group is found, then dissociate it.
         */
        if (!$group) {
            $group = null;
        }

        $project->group()->associate($group);
        $project->save();
    }

    public function refreshToken(Request $request, $id)
    {
        $project = $request->user()
            ->projects()
            ->findOrFail($id);

        $project->key = Str::random(50);
        $project->save();

        return redirect()->back()->with('success', 'A new API token has been generated');
    }
}
