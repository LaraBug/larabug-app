<?php

namespace App\Http\Controllers\Api;

use App\Models\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExceptionController extends Controller
{
    public function recentExceptions(Request $request)
    {
        $projects = $request->user()->projects()->get(['id'])->pluck('id')->toArray();

        return Exception::whereIn('project_id', $projects)
            ->latest()
            ->paginate(15, [
                'class',
                'created_at',
                'error',
                'exception',
                'id',
                'project_id',
                'line',
                'status'
            ]);
    }

    public function show(Request $request, $exceptionId)
    {
        $projects = $request->user()->projects()->get(['id'])->pluck('id')->toArray();

        $exception = Exception::whereIn('project_id', $projects)
            ->findOrFail($exceptionId, [
                'class',
                'created_at',
                'error',
                'exception',
                'id',
                'project_id',
                'line',
                'status'
            ]);

        if ($exception->status == Exception::OPEN) {
            $exception->markAsRead();
            $exception->markAsMailed();
        }

        $exception->load(['project' => function ($query) {
            return $query->select('title', 'id');
        }]);

        return $exception;
    }

    public function markAs(Request $request, $exceptionId)
    {
        $projects = $request->user()->projects()->get(['id'])->pluck('id')->toArray();

        $exception = Exception::whereIn('project_id', $projects)
            ->findOrFail($exceptionId);

        $exception->markAs($request->input('status'));

        /*
         * Also mark as mailed because the user would already know about this exception
         */
        $exception->markAsMailed();

        return $request->input('status');
    }
}
