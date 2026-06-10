<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Usage: Route::middleware('role:admin') or Route::middleware('role:admin,therapist')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!session('user')) {
            return redirect('/login');
        }

        $userRole = session('role');

        if (!in_array($userRole, $roles)) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}
