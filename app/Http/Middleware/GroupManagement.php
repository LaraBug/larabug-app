<?php

namespace App\Http\Middleware;

use Closure;

class GroupManagement
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->canManageGroups()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
