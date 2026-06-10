<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebAuth
{
    /**
     * Handle an incoming request.
     * Checks that a web session ('user') exists — not JWT.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Use $request->session() for reliable session access
        if (!$request->session()->has('user') || !$request->session()->get('user')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
