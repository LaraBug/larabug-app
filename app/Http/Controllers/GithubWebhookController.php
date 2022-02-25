<?php

namespace App\Http\Controllers;

use App\Jobs\Projects\ProcessGithubWebhookJob;
use Illuminate\Http\Request;

class GithubWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        dispatch(new ProcessGithubWebhookJob($request->header('X-GitHub-Event'), $request->all()));
    }
}