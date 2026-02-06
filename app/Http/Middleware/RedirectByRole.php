<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectByRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $role = Auth::user()->role;

        // Admin cuba masuk user page
        if ($role === 'admin' && $request->is('dashboard', 'user/*')) {
            return redirect()->route('admin.dashboard');
        }

        // User cuba masuk admin page
        if ($role === 'user' && $request->is('admin/*')) {
            return redirect()->route('dashboard');
        }

        // Technician cuba masuk selain technician
        if ($role === 'technician' && !$request->is('technician/*')) {
            return redirect()->route('technician.dashboard');
        }

        // Block login page bila dah login
        if ($request->is('login')) {
            return match ($role) {
                'admin' => redirect()->route('admin.dashboard'),
                'technician' => redirect()->route('technician.dashboard'),
                default => redirect()->route('dashboard'),
            };
        }

        return $next($request);
    }
}
