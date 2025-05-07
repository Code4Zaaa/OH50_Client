<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the host IP
        $hostIp = $request->server("SERVER_ADDR", env("HOST_IP"));

        // Get the client's IP
        $clientIp = $request->ip();

        // Check if the host IP matches the client's IP
        if ($hostIp !== $clientIp) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
