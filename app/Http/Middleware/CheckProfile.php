<?php

namespace App\Http\Middleware;

use Closure;

class CheckProfile
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
        if ($profile != 3 && $profile != 5)
        {
            return redirect('home');
        }
        else {
            return $next($request);
        }
    }
}
