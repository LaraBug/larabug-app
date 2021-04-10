<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Feedback;
use App\Models\Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class FeedbackTest extends TestCase
{
    /** @test */
    public function it_belongs_to_an_exception()
    {
        Notification::fake();
        Mail::fake();

        $feedback = factory(Feedback::class)->create();

        $this->assertInstanceof(Exception::class, $feedback->exception);
    }
}
