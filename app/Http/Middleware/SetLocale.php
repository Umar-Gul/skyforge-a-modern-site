<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Applies the visitor's chosen language (stored in the session by GET /lang/{locale}).
 * Supported languages are listed in config/skyforge.php under 'locales'.
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', config('app.locale', 'en'));

        if (! array_key_exists($locale, config('skyforge.locales', []))) {
            $locale = 'en';
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
