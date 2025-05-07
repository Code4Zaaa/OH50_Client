<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class masuk
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('nama') != env('UNTUK_MASUK_AKUN', 0) || session('pass') != env('UNTUK_MASUK_SANDI', 0)) {
            return redirect('/');
        }
        return $next($request);
    }
}
