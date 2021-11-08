<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function script(Request $request)
    {
        $project = Project::whereHas('users', function ($query) {
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
