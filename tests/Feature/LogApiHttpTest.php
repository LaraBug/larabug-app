<?php

use App\Models\Project;
use App\Models\User;
use App\Notifications\Discord\DiscordChannel;
use App\Notifications\ExceptionWasCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Webhook\WebhookChannel;

use function Pest\Laravel\be;

beforeEach(function () {
    Notification::fake();
    Mail::fake();

    $this->project = Project::factory()->create();
    $this->user = User::factory()->create();
    $this->user->projects()->save($this->project, ['owner' => true]);
});

it('logs an exception', function () {
    expect($this->project->exceptions)
        ->toHaveCount(0);

    be($this->user, 'api')->post(route('exceptions.log'), [
        'project' => $this->project->key,
        'exception' => [
            'exception' => 'Whoops something seems to have gone wrong..',
        ],
    ])->assertOk();

    expect($this->project->fresh()->exceptions)
        ->toHaveCount(1);

    Notification::assertSentTo(
        [$this->project],
        ExceptionWasCreated::class
    );
});

it('logs an exception without notification', function () {
    $this->project->update(['notifications_enabled' => false]);

    expect($this->project->exceptions)
        ->toHaveCount(0);

    be($this->user, 'api')->post(route('exceptions.log'), [
        'project' => $this->project->key,
        'exception' => [
            'exception' => 'Whoops something seems to have gone wrong..',
        ],
    ])->assertOk();

    expect($this->project->fresh()->exceptions)
        ->toHaveCount(1);

    Notification::assertNothingSent();
});

it('logs an exception and sends notification to discord', function () {
    $this->project->update(
        ['discord_webhook_enabled' => true, 'discord_webhook' => 'https://discordapp.com/api/webhooks']
    );

    expect($this->project->exceptions)
        ->toHaveCount(0);

    be($this->user, 'api')->post(route('exceptions.log'), [
        'project' => $this->project->key,
        'exception' => [
            'exception' => 'Whoops something seems to have gone wrong..',
        ],
    ])->assertOk();

    Notification::assertSentTo(
        $this->project,
        ExceptionWasCreated::class,
        function ($notification, $channels, $notifiable) {
            return $channels === [DiscordChannel::class];
        }
    );
});

it('logs an exception and sends notification to custom webhook', function () {
    $this->project->update(['custom_webhook_enabled' => true, 'custom_webhook' => 'https://example.com/custom-webhook']
    );

    expect($this->project->exceptions)
        ->toHaveCount(0);

    be($this->user, 'api')->post(route('exceptions.log'), [
        'project' => $this->project->key,
        'exception' => [
            'exception' => 'Whoops something seems to have gone wrong..',
        ],
    ])->assertOk();

    Notification::assertSentTo(
        $this->project,
        ExceptionWasCreated::class,
        function ($notification, $channels, $notifiable) {
            return $channels === [WebhookChannel::class];
        }
    );
});

it('logs an exception and sends notification to slack', function () {
    $this->project->update(['slack_webhook_enabled' => true, 'slack_webhook' => 'https://hooks.slack.com/services/']);

    expect($this->project->exceptions)
        ->toHaveCount(0);

    be($this->user, 'api')->post(route('exceptions.log'), [
        'project' => $this->project->key,
        'exception' => [
            'exception' => 'Whoops something seems to have gone wrong..',
        ],
    ])->assertOk();

    Notification::assertSentTo(
        $this->project,
        ExceptionWasCreated::class,
        function ($notification, $channels, $notifiable) {
            return $channels === ['slack'];
        }
    );
});

it('logs an exception and sends notification to fcm', function () {
    $this->user->fcmTokens()->create(['token' => 'test', 'device' => 'example']);

    $this->project->update(['mobile_notifications_enabled' => true]);

    expect($this->project->exceptions)
        ->toHaveCount(0);

    be($this->user, 'api')->post(route('exceptions.log'), [
        'project' => $this->project->key,
        'exception' => [
            'exception' => 'Whoops something seems to have gone wrong..',
        ],
    ])->assertOk();

    Notification::assertSentTo(
        $this->project,
        ExceptionWasCreated::class,
        function ($notification, $channels, $notifiable) {
            return $channels === [FcmChannel::class];
        }
    );
});

it('logs an exception and sends multiple notifications', function ()
{
    $this->user->fcmTokens()->create(['token' => 'test', 'device' => 'example']);
    $this->project->update(
        ['discord_webhook_enabled' => true, 'discord_webhook' => 'https://discordapp.com/api/webhooks']
    );
    $this->project->update(['custom_webhook_enabled' => true, 'custom_webhook' => 'https://example.com/custom-webhook']
    );
    $this->project->update(['slack_webhook_enabled' => true, 'slack_webhook' => 'https://hooks.slack.com/services/']);
    $this->project->update(['mobile_notifications_enabled' => true]);

    expect($this->project->exceptions)
        ->toHaveCount(0);

    be($this->user, 'api')->post(route('exceptions.log'), [
        'project' => $this->project->key,
        'exception' => [
            'exception' => 'Whoops something seems to have gone wrong..',
        ],
    ])->assertOk();

    Notification::assertSentTo(
        $this->project,
        ExceptionWasCreated::class,
        function ($notification, $channels, $notifiable) {
            return $channels === ['slack', DiscordChannel::class, WebhookChannel::class, FcmChannel::class];
        }
    );
});

