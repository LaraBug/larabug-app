<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use JShrink\Minifier;

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

    public function script()
    {
        $file = resource_path('assets/js/feedback/feedback.js');

        $minified = Minifier::minify(file_get_contents($file));

        return response($minified)->withHeaders([
            'Content-Type' => 'application/javascript'
        ]);
    }
}
