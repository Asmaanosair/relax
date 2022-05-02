<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param string $locale
     * @return \Illuminate\Http\Response
     */
    public function __invoke($locale)
    {
        if (in_array($locale, config('relax.locales'))) {
            return back()->withCookie(cookie('__locale', $locale));
        }

        return back();
    }
}
