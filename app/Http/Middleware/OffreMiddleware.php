<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OffreMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || 
            !in_array(auth()->user()->ref_role, [2, 3, 4, 5, 6])) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}

