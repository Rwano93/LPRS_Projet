<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Vérifie si l'utilisateur est connecté et a le rôle requis
        if (!Auth::check() || !$request->user()->hasRole($role)) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
