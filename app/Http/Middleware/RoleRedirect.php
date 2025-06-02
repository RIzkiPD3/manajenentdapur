<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $role = auth()->user()->role ?? null;

        if ($role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($role === 'petugas') {
            return redirect('/petugas/dashboard');
        } elseif ($role === 'angkatan') {
            return redirect('/angkatan/dashboard');
        }

        return $next($request);
    }

}
