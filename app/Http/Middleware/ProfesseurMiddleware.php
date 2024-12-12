<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProfesseurMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->ref_role == 4) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', "Vous n'avez pas l'autorisation d'accéder à cette page.");
    }
}