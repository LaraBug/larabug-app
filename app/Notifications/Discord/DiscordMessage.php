<?php

namespace App\Notifications\Discord;

class DiscordMessage
{
    /**
     * The text content of the message.
     *
     * @var string
     */
    public $content;
    public $username;
    public $image;
    public $embeds;

    /**
     * Set the text content of the message.
     *
     * @param string $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    public function from($name)
    {
        $this->username = $name;

        return $this;
    }

    public function image($image)
    {
        $this->image = $image;

        return $this;
    }

    public function embeds(array $embeds)
    {
        $this->embeds = $embeds;

        return $this;
    }
}
