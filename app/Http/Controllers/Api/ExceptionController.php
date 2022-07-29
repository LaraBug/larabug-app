<?php

namespace App\Http\Controllers\Api;

use App\Models\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ExceptionResource;

class ExceptionController extends Controller
{
    public function index(Request $request)
    {
        return ExceptionResource::collection(
            Exception::query()->whereIn('project_id', $request->user()->projects()->pluck('id')->toArray())
                ->with('project:id,title')
                ->latest('created_at')
                ->limit(8)
                ->get()
        );
    }

    public function show(Request $request, $exceptionId)
    {
        $exception = Exception::query()->whereIn('project_id', $request->user()->projects()->pluck('id')->toArray())
            ->findOrFail($exceptionId);

        if ($exception->status == Exception::OPEN) {
            $exception->markAsRead();
            $exception->markAsMailed();
        }

        return new ExceptionResource($exception);
    }

    public function read(Request $request, $exceptionId)
    {
        $projects = $request->user()->projects()->get(['id'])->pluck('id')->toArray();

        $exception = Exception::query()->whereIn('project_id', $projects)
            ->findOrFail($exceptionId);

        $exception->markAsRead();

        /*
         * Also mark as mailed because the user would already know about this exception
         */
        $exception->markAsMailed();

        return new ExceptionResource($exception);
    }

    public function togglePublic(Request $request, $exceptionId)
    {
        $exception = Exception::query()->whereIn('project_id', $request->user()->projects()->pluck('id')->toArray())->findOrFail($exceptionId);

        if ($exception->publish_hash) {
            $exception->removePublic();
        } else {
            $exception->makePublic();
        }

        return new ExceptionResource($exception);
    }

    public function destroy(Request $request, $exceptionId)
    {
        $exception = Exception::query()->whereIn('project_id', $request->user()->projects()->pluck('id')->toArray())
            ->findOrFail($exceptionId);

        $exception->delete();

        return response('ok');
    }
}
