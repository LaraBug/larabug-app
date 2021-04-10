<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExceptionEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $collection;

    /**
     * Create a new message instance.
     *
     * @param array $collection
     */
    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->collection['email'], $this->collection['name'])
            ->subject('New exceptions in projects ' . $this->collection['projects']->take(3)->pluck('title')->implode(', '))
            ->markdown('emails.exception');
    }
}
