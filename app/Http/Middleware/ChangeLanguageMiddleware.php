<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeLanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (request()->hasHeader('lang')){    // تاكد انه يحتوي علي lang
            app()->setLocale(request()->header('lang'));// حطلي ال هيجيلك من header  في lang
        }else{
            app()->setLocale('en'); //default en
        }
//        dd(app()->getLocale());

        return $next($request);
    }
}
