<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');

        if ($apiKey !== env('APP_API_KEY')) {
            return response()->json(['error' => 'API Key Tidak Valid! Akses ditolak.'], 401);
        }

        return $next($request);
    }
}