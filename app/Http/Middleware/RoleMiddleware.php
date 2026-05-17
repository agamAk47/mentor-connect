<?php

namespace App\Http\Middleware;

use App\Models\Mentor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * RoleMiddleware
 *
 * Demonstrates:
 * - Custom Middleware (Unit III)
 * - Session data retrieval (Unit IV)
 * - Route protection and redirects (Unit II, III)
 */
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role = null): Response
    {
        // Check if user is authenticated via session (Unit IV)
        if (!$request->session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // Check if a specific role is required, and verify if the user matches it
        if ($role && $request->session()->get('user_role') !== $role) {
            return redirect()->route('home')->with('error', 'Unauthorized access. You do not have the required permissions.');
        }

        // Mentor must be approved by admin (Unit VI)
        if ($role === 'mentor') {
            $mentor = Mentor::find($request->session()->get('user_id'));
            if ($mentor && $mentor->status !== 'approved') {
                $message = $mentor->status === 'rejected'
                    ? 'Your mentor registration was rejected. Please contact support.'
                    : 'Your mentor account is pending admin approval.';

                return redirect()->route('login')->with('error', $message);
            }
        }

        return $next($request);
    }
}
