<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
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
        $locale = $request->cookies->get('__locale');

        if ($locale && in_array($locale, config('relax.locales'))) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
