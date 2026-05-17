<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * AdminMiddleware
 *
 * Demonstrates:
 * - Custom Middleware for admin routes (Unit III)
 * - Session-based role check (Unit IV)
 */
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('user_id') || $request->session()->get('user_role') !== 'admin') {
            return redirect()->route('login')->with('error', 'Admin access required.');
        }

        return $next($request);
    }
}
