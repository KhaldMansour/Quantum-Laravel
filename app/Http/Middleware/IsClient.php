<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsClient
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
        if(!auth()->user() || auth()->user()->is_admin)
        {
            return response()->json([
                'message' => 'Unauthorized',
            ] , 403);
        }
        return $next($request);
    }
}
