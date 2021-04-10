<?php

namespace App\Http\Middleware;

use Closure;

class HasFeature
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param null $feature
     * @return mixed
     */
    public function handle($request, Closure $next, $feature = null)
    {
        if (
            $feature == 'feedback' &&
            object_get($request->user()->subscription('default'), 'stripe_plan') !='unlimited'
        ) {
            return redirect()->route('panel.billing.show')->with('error', 'You need a paid subscription to do this');
        }

        return $next($request);
    }
}
