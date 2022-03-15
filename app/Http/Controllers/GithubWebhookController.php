<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\GitHub\Webhook\ProcessJob;

class GithubWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        dispatch(new ProcessJob($request->header('X-GitHub-Event'), $request->all()));
    }
}