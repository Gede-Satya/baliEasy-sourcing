<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request and set application locale from session.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = ['en', 'id'];

        $locale = session('locale', config('app.locale', 'en'));

        if (in_array($locale, $supportedLocales, true)) {
            App::setLocale($locale);
        } else {
            App::setLocale('en');
        }

        return $next($request);
    }
}

