<?php

namespace App\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use App\Models\Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Jobs\Projects\ProcessException;
use App\Http\Requests\Api\FeedbackRequest;

class ApiController extends Controller
{
    public function log(Request $request)
    {
        /* @var $user \App\Models\User */
        $user = $request->user();

        if (!$user->hasVerifiedEmail()) {
            return response()->json([
                'error' => 'This is not an verified account.'
            ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $project = $user->projects()->where('key', $request->input('project'))->firstOrFail();

        // Legacy support for LaraBug packages lower than version 2
        if ($legacyExecutor = $request->input('exegutor')) {
            $request->merge(['executor' => $legacyExecutor]);
        }

        if (
            !Arr::get($request->input('exception'), 'exception')
        ) {
            return response()->json([
                'error' => 'Did not receive the correct parameters to process this exception'
            ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        dispatch_sync(new ProcessException([
            'id' => $id = Uuid::uuid4(),
            'host' => array_get($request->input('exception'), 'host'),
            'environment' => array_get($request->input('exception'), 'environment'),
            'error' => array_get($request->input('exception'), 'error'),
            'additional' => $request->input('additional'),
            'method' => array_get($request->input('exception'), 'method'),
            'class' => array_get($request->input('exception'), 'class'),
            'file' => array_get($request->input('exception'), 'file'),
            'file_type' => array_get($request->input('exception'), 'file_type', 'php'),
            'line' => array_get($request->input('exception'), 'line'),
            'fullUrl' => array_get($request->input('exception'), 'fullUrl'),
            'executor' => array_get($request->input('exception'), 'executor'),
            'storage' => array_get($request->input('exception'), 'storage'),
            'exception' => str_limit(array_get($request->input('exception'), 'exception'), 10000),
            'user' => $request->input('user'),
            'project_version' => array_get($request->input('exception'), 'project_version'),
        ], $project, now()));

        return response([
            'id' => $id
        ]);
    }

    public function feedback(FeedbackRequest $request)
    {
        // TODO: Fix validation
        $exception = Exception::findOrFail($request->get('id'));
        $exception->feedback()->create(
            $request->only([
                'name',
                'email',
                'feedback'
            ])
        );

        return response([
            'success' => true
        ]);
    }
}
