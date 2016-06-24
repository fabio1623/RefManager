<?php

namespace App\Http\Middleware;

use Closure;

class IsAuthorizedReference
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $profile)
    {
        return $next($request);
    }
}
