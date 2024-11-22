<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GestionnaireMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->ref_role != 6) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}