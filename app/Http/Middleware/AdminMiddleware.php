<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Biarkan rute login dan register tetap bisa diakses
        if ($request->routeIs('login') || $request->routeIs('register')) {
            return $next($request);
        }

        if (! auth()->check()) {
            return redirect()->route('login');
        }

        if (! auth()->user()->hasRole('admin') && ! auth()->user()->hasRole('super-admin')) {
            return redirect('/')->with('error', 'Anda tidak memiliki hak akses ke area Admin.');
        }

        return $next($request);
    }
}
