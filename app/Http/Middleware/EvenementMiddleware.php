<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EvenementMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->ref_role != 2 || auth()->user()->ref_role != 3 || auth()->user()->ref_role != 4 || auth()->user()->ref_role != 5|| auth()->user()->ref_role != 6 ) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}