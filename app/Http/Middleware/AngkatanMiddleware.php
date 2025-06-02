<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AngkatanMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()?->role !== 'angkatan') {
            abort(403, 'Unauthorized: Angkatan Only');
        }

        return $next($request);
    }
}

