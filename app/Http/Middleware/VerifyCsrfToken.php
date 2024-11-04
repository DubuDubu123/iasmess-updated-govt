<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Symfony\Component\HttpFoundation\Cookie;
use Closure;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'broadcasting/auth',
        'api/spa/*',
        'upload',
        'test',
        'test-sbi',
        'success',
        'failure',
    ];

    /**
     * Add the CSRF token to the response cookies with Secure flag.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = parent::handle($request, $next);

        // Add the Secure flag to the XSRF-TOKEN
        $response->headers->setCookie(
            new Cookie(
                'XSRF-TOKEN', // Cookie name
                $request->session()->token(), // Cookie value (the CSRF token)
                time() + 60 * 120, // Expiration time (120 minutes)
                '/', // Path
                null, // Domain (null means current domain)
                $request->secure(), // Only send over HTTPS
                false, // HttpOnly flag (set to false, as JavaScript needs access)
                false, // Raw (set to false)
                'Lax' // SameSite attribute
            )
        );

        return $response;
    }
}
