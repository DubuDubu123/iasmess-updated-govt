<?php

namespace App\Http\Middleware;

use Closure;

class PreventClickjacking
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
        $response = $next($request);

        // Set X-Frame-Options header
        $response->headers->set('X-Frame-Options', 'DENY');

        // Set Content-Security-Policy header
        //  $response->headers->set('Content-Security-Policy', "default-src 'self'; frame-src 'none';");
        $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self'; img-src 'self'; connect-src 'self'; frame-src 'none';");

        return $response;
    }
}
