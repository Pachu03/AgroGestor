<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        $locale = Session::get('applocale', config('app.locale'));
        \Log::info("Locale set to: " . $locale);
        App::setLocale($locale);

        return $next($request);
    }
}
