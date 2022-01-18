<?php

namespace App\Jobs\GitHub;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\GitHubWebhooks\Models\GitHubWebhookCall;

class HandleAllJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public GitHubWebhookCall $webhookCall;

    public function __construct(GitHubWebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        //
        ray($this->webhookCall->eventActionName());
    }
}