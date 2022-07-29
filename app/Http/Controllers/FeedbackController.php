<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $feedback = Feedback::with(['exception', 'exception.project'])
            ->whereHas('exception', function ($query) use ($request) {
                $query->whereIn('project_id', $request->user()->projects->map->id);
            })
            ->latest()
            ->paginateFilter();

        return inertia('Feedback/Index', [
            'feedback' => $feedback
        ]);
    }

    public function script(Request $request)
    {
        $project = Project::query()->whereHas('users', function ($query) {
            return $query
                ->where('project_user.owner', true);
        })
            ->findOrFail($request->input('project'));

        $file = resource_path('assets/js/feedback/feedback.js');

        $minified = \JShrink\Minifier::minify(file_get_contents($file));

        return response($minified)->withHeaders([
            'Content-Type' => 'application/javascript'
        ]);
    }
}
