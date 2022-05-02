<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIsPatient
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
        if(!auth()->user()->isPatient()){
            return back();
        }
        return $next($request);
    }
}
