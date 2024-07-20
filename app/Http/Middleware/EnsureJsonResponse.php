<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $response = $next($request);

            if ($response instanceof Response && $response->isRedirection() && $request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            return $response;
        } catch (\Illuminate\Auth\AuthenticationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            throw $e;
        }
    }
}
