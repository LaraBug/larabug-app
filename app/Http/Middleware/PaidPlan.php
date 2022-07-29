<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class PaidPlan
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* @var $user \App\Models\User */
        $user = $request->user();

        if (
            $user &&
            !$user->subscribed('default') &&
            !$user->onTrial()
        ) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Your subscription is not sufficient to do this.'
                ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            // This user is not a paying customer...
            return redirect()->route('panel.billing.show')->with('error', 'You need a paid subscription to do this');
        }

        return $next($request);
    }
}
