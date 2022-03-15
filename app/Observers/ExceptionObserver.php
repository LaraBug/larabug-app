<?php

namespace App\Observers;

use App\Models\Issue;
use App\Models\Exception;

class ExceptionObserver
{
    public function created(Exception $exception)
    {
        // Check for issue
        $issue = Issue::firstOrCreate([
            'exception' => $exception->exception,
            'project_id' => $exception->project_id,
        ], [
            'exception_id' => $exception->id,
            'status' => 'open',
        ]);

        $issue->update([
            'last_exception_at' => $exception->created_at,
            'status' => 'open',
        ]);

        //
        $exception->issue()->associate($issue);
        $exception->save();
    }
}