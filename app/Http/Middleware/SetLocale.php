<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowedLocales = ['ar', 'en', 'nl'];

        $isAdmin = $request->is('admin/*') || $request->is('dashboard') || $request->is('login');

        $defaultLocale = $isAdmin
            ? setting('admin_default_locale', 'en')
            : setting('site_default_locale', 'en');

        if (! in_array($defaultLocale, $allowedLocales, true)) {
            $defaultLocale = 'en';
        }

        $locale = $request->session()->get('locale', $defaultLocale);

        if (! in_array($locale, $allowedLocales, true)) {
            $locale = $defaultLocale;
        }

        app()->setLocale($locale);

        return $next($request);
    }
}