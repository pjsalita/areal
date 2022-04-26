<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActivatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            auth()->check()
            && auth()->user()->account_type === "architect"
            && !auth()->user()->prc_verified
        ) {
            return redirect()->route('feed');
        }

        return $next($request);
    }
}
