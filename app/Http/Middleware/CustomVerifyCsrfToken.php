<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Symfony\Component\HttpFoundation\Cookie;

class CustomVerifyCsrfToken extends BaseVerifier
{
    /**
     * Override the method to add HttpOnly flag for the XSRF-TOKEN.
     */
    protected function addCookieToResponse($request, $response)
    {
        $config = config('session');

        if ($response instanceof Responsable) {
            $response = $response->toResponse($request);
        }

        // Set HttpOnly to true in the cookie definition
        $response->headers->setCookie(
            new Cookie(
                'XSRF-TOKEN', 
                $request->session()->token(), 
                $this->availableAt(60 * $config['lifetime']),
                $config['path'], 
                $config['domain'], 
                $config['secure'], // Keep this as per session config
                true,  // Set HttpOnly to true
                false, // Raw flag remains false
                $config['same_site'] ?? null
            )
        );

        return $response;
    }
}