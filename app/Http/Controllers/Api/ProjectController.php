<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ExceptionResource;

class ProjectController extends Controller
{
    public function list(Request $request)
    {
        return $request->user()
            ->projects()
            ->get(['id', 'title', 'last_error_at', 'description', 'total_exceptions', 'url']);
    }

    public function show(Request $request, $id)
    {
        return $request->user()
            ->projects()
            ->findOrFail($id);
    }

    public function exceptions(Request $request, $id)
    {
        $project = $request->user()
            ->projects()
            ->where('key', $id)
            ->firstOrFail();

        return ExceptionResource::collection($project->exceptions()
            ->latest()
            ->paginate());
    }

    public function exception(Request $request, $id, $exceptionId)
    {
        $project = $request->user()
            ->projects()
            ->where('key', $id)
            ->firstOrFail();

        return new ExceptionResource($project->exceptions()
            ->findOrFail($exceptionId));
    }

    public function store(Request $request)
    {
        if ($request->user()->plan->max_projects != 0 && $request->user()->projects()->count() >= $request->user()->plan->max_projects) {
            return response('You have currently reached the max limit for your projects. Please upgrade your account.', 422);
        }

        $project = Project::create($request->only([
            'title',
            'description',
            'url',
            'receive_email'
        ]));

        $request->user()->projects()->save($project, ['owner' => true]);

        return $project;
    }
}
