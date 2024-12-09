<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EntrepriseAlumni
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !in_array(auth()->user()->ref_role, [3, 5, 6])) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}