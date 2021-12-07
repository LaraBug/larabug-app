<?php

namespace App\Events;

use App\Models\Exception;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateOrUpdateIssue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $exception;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }
}
