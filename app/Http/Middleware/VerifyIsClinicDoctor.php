<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIsClinicDoctor
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
        if(!auth()->user()->isClinicDoctor()){
            return back();
        }
        return $next($request);
    }
}
