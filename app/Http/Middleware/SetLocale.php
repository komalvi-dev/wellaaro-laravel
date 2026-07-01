<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $available = array_keys(config('locales.available'));
        $default = config('locales.default');

        $locale = $request->query('locale', session('locale', $default));

        if (!in_array($locale, $available, true)) {
            $locale = $default;
        }

        session(['locale' => $locale]);
        app()->setLocale($locale);

        return $next($request);
    }
}
