<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowedLocales = ['en', 'bn'];
        $locale = (string) $request->session()->get('locale', config('app.locale'));

        if (!in_array($locale, $allowedLocales, true)) {
            $locale = config('app.locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
