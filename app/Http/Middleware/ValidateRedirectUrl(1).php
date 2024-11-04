<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateRedirectUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $redirectUrl = $request->query('redirect');
        // dd($redirectUrl);
        if ($redirectUrl && !$this->isValidUrl($redirectUrl)) {
            // Optionally, log or handle invalid redirection attempts
            return abort(403, 'Unauthorized redirection.');
        }

        return $next($request);
    }

    /**
     * Validate if the URL is in the whitelist or is a relative URL
     *
     * @param  string  $url
     * @return bool
     */
    private function isValidUrl($url)
    {
        // Allow relative URLs
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return true;
        }

        // Define your whitelist of trusted domains
        $trustedDomains = [
            'iasmess.dubudubutechnologies.com', 
        ];

        $host = parse_url($url, PHP_URL_HOST);

        return in_array($host, $trustedDomains);
    }
}