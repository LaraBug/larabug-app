<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Discord\DiscordChannel;
use App\Notifications\Discord\DiscordMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class TestWebhook extends Notification implements ShouldQueue
{
    use Queueable;

    private $project;
    private $type;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Project $project
     * @param string              $type
     */
    public function __construct(Project $project, $type = 'slack')
    {
        $this->project = $project;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        if ($this->type == 'slack') {
            return ['slack'];
        } else {
            return [DiscordChannel::class];
        }
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content('['. $notifiable->title .'] - If you see this message then you have succesfully tested your Slack webhook.');
    }

    public function toDiscord($notifiable)
    {
        return DiscordMessage::create('['. $notifiable->title .'] - If you see this message then you have succesfully tested your Discord webhook.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
