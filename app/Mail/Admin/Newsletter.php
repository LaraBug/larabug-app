<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Newsletter extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $subject;
    public $content;
    public $user;

    /**
     * NewsletterMail constructor.
     * @param $user
     * @param $subject
     * @param $content
     */
    public function __construct($user, $subject, $content)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('emails.admin.newsletter')
            ->subject($this->subject);
    }
}
