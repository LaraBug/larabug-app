<?php

namespace Tests\Feature;

use App\Models\Feedback;
use App\Models\Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

it('belongs to an exception', function () {
    Notification::fake();
    Mail::fake();

    expect(Feedback::factory()->create()->exception)
        ->toBeInstanceOf(Exception::class);
});
