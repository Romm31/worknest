<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     * Ensures the authenticated user has an employee profile.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Admin users can access employee routes (for viewing purposes)
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Check if user has an employee profile
        if (!$user->employee) {
            abort(403, 'Access denied. Employee profile required.');
        }

        return $next($request);
    }
}
