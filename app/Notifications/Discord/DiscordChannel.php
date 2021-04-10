<?php

namespace App\Notifications\Discord;

use Illuminate\Notifications\Notification;

class DiscordChannel
{
    protected $discord;

    /**
     * @param \App\Utilities\Discord\Discord $discord
     */
    public function __construct(Discord $discord)
    {
        $this->discord = $discord;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed                                  $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($notifiable, Notification $notification)
    {
        /* @var $message \App\Utilities\Discord\DiscordMessage */
        $message = $notification->toDiscord($notifiable);

        $this->discord->send($notifiable, [
            'content' => str_limit($message->content, 1500),
            'username' => $message->username,
            'avatar_url' => $message->image,
            'embeds' => $message->embeds,
        ]);
    }
}
