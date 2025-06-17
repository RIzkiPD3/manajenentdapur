<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AngkatanMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('angkatan.login')->withErrors(['msg' => 'Silakan login terlebih dahulu.']);
        }

        // Cek apakah role-nya bukan angkatan
        if (auth()->user()->role !== 'angkatan') {
            abort(403, 'Unauthorized: Angkatan Only');
        }

        return $next($request);
    }
}
