<?php

use Spatie\GitHubWebhooks\Models\GitHubWebhookCall;
use Spatie\GitHubWebhooks\Jobs\ProcessGitHubWebhookJob;
use Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile;

return [
    /*
     * GitHub will sign each webhook using a secret. You can find the used secret at the
     * webhook configuration settings: https://docs.github.com/en/developers/webhooks-and-events/webhooks/about-webhooks.
     */
    'signing_secret' => env('GITHUB_WEBHOOK_SECRET', 'abc123'),

    /*
     * You can define the job that should be run when a certain webhook hits your application
     * here.
     *
     * You can find a list of GitHub webhook types here:
     * https://docs.github.com/en/developers/webhooks-and-events/webhooks/webhook-events-and-payloads.
     *
     * You can use "*" to let a job handle all sent webhook types
     */
    'jobs' => [
        // 'ping' => \App\Jobs\GitHubWebhooks\HandlePingWebhook::class,
        // 'issues.opened' => \App\Jobs\GitHubWebhooks\HandleIssueOpenedWebhookJob::class,
        'issues.closed' => \App\Jobs\GitHub\HandleIssueClosedJob::class,
        'issues.reopened' => \App\Jobs\GitHub\HandleIssueReopenedJob::class,
        //'*' => \App\Jobs\Github\HandleAllJob::class,
    ],

    /*
     * This model will be used to store all incoming webhooks.
     * It should be or extend `Spatie\GitHubWebhooks\Models\GitHubWebhookCall`
     */
    'model' => GitHubWebhookCall::class,

    /*
     * When running `php artisan model:prune` all stored GitHub webhook calls
     * that were successfully processed will be deleted.
     *
     * More info on pruning: https://laravel.com/docs/8.x/eloquent#pruning-models
     */
    'prune_webhook_calls_after_days' => 10,

    /*
     * The classname of the job to be used. The class should equal or extend
     * Spatie\GitHubWebhooks\ProcessGitHubWebhookJob.
     */
    'job' => ProcessGitHubWebhookJob::class,

    /**
     * This class determines if the webhook call should be stored and processed.
     */
    'profile' => ProcessEverythingWebhookProfile::class,

    /*
     * When disabled, the package will not verify if the signature is valid.
     * This can be handy in local environments.
     */
    'verify_signature' => env('GITHUB_SIGNATURE_VERIFY', true),
];
