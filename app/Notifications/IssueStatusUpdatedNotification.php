<?php

namespace App\Notifications;

use App\Models\Issue;
use App\Notifications\CustomWebhook\WebhookChannel;
use App\Notifications\CustomWebhook\WebhookMessage;
use App\Notifications\Discord\DiscordChannel;
use App\Notifications\Discord\DiscordMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

class IssueStatusUpdatedNotification extends Notification
{
    public function __construct(public Issue $issue)
    {
    }

    public function via($notifiable): array
    {
        $array = [];

        if ($notifiable->issue_slack_webhook_enabled && $notifiable->issue_slack_webhook) {
            $array[] = 'slack';
        }

        if ($notifiable->issue_discord_webhook_enabled && $notifiable->issue_discord_webhook) {
            $array[] = DiscordChannel::class;
        }

        if ($notifiable->issue_custom_webhook_enabled && $notifiable->issue_custom_webhook) {
            $array[] = WebhookChannel::class;
        }

        if ($notifiable->issue_mobile_notifications_enabled && $notifiable->users()->wherePivot('owner', true)->first()?->fcmTokens()->exists()) {
            $array[] = FcmChannel::class;
        }

        return $array;
    }

    public function toDiscord()
    {
        return (new DiscordMessage())
            ->from('larabug.com')
            ->image(asset('images/larabug-logo-small.png'))
            ->embeds([
                [
                    'color' => 13772369,
                    'title' => '[' . $this->issue->project->title . '] Issue status changed',
                    'description' => $this->issue->exception,
                    'fields' => [
                        [
                            'name' => 'Status',
                            'value' => $this->issue->status_text ?? 'test',
                            'inline' => true,
                        ],
                    ]
                ],
            ]);
    }

    public function toSlack()
    {
        return (new SlackMessage())
            ->error()
            ->content('[' . $this->issue->project->title . '] Issue status changed')
            ->attachment(function ($attachment) {
                $attachment->title($this->issue->exception, route('panel.issues.show', $this->issue->id))
                    ->fields([
                        'Status' => $this->issue->status_text,
                    ]);
            });
    }

    public function toWebhook()
    {
        return WebhookMessage::create()
            ->data([
                'Exception' => $this->issue->exception,
                'RouteUrl' => route('panel.issues.show', $this->issue->id),
                'Status' => $this->issue->status,
                'StatusText' => $this->issue->status_text,
            ])
            ->userAgent("LaraBug");
    }

    public function toFcm()
    {
        return FcmMessage::create()
            ->setData(['issue_id' => $this->issue->id, 'project_id' => $this->issue->project_id])
            ->setNotification(
                \NotificationChannels\Fcm\Resources\Notification::create()
                    ->setTitle('Issue status changed to ' . $this->issue->status_text)
                    ->setBody(Str::limit($this->issue->exception) . ' - ' . $this->issue->project->title)
                    ->setImage('https://www.larabug.com/favicon.ico')
            )
            // Android sound
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()->setSound('default'))
            )
            // Apple sound
            ->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios'))
                    ->setPayload(['aps' => ['sound' => 'default']])
            );
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
