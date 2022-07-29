<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProjectRequest;
use App\Http\Resources\Api\ProjectResource;
use App\Http\Resources\Api\ExceptionResource;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return ProjectResource::collection(
            $request->user()
                ->projects()
                ->when($request->input('search'), function ($query, $value) {
                    return $query->where('title', 'like', '%' . $value . '%');
                })
                ->withCount('unreadExceptions')
                ->latest('last_error_at')
                ->latest('created_at')
                ->paginate()
        );
    }

    public function show(Request $request, $id)
    {
        return new ProjectResource(
            $request->user()->projects()->findOrFail($id)
        );
    }

    public function exceptions(Request $request, $id)
    {
        $project = $request->user()
            ->projects()
            ->findOrFail($id);

        return ExceptionResource::collection(
            $project->exceptions()
                ->when($request->input('search'), function ($query, $value) {
                    return $query->where('exception', 'like', '%' . $value . '%');
                })
                ->latest()
                ->paginate()
        );
    }

    public function exception(Request $request, $id, $exceptionId)
    {
        $project = $request->user()
            ->projects()
            ->findOrFail($id);

        return new ExceptionResource(
            $project->exceptions()->findOrFail($exceptionId)
        );
    }

    public function store(ProjectRequest $request)
    {
        $project = Project::query()->create($request->only([
            'title',
            'description',
            'url',
        ]));

        $request->user()->projects()->save($project, ['owner' => true]);

        return new ProjectResource($project);
    }
}
