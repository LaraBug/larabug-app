<?php

namespace App\Events;

use App\Models\Exception;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class ExceptionWasCreated
{
    use InteractsWithSockets, SerializesModels;

    public $exception;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Exception $exception
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }
}
