<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LocalizationMiddleware
{
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(2); // Assumes language code as the first segment of the URL

        if (!in_array($locale, ['en', 'fr', 'ar'])) {
            // Handle invalid or missing locales here.
        }

        App::setLocale($locale);

        return $next($request);
    }
}
