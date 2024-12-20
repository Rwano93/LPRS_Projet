<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\DemandeChangementStatut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Entreprise::class => EntreprisePolicy::class,
    ];
    public function boot()
    {

        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->ref_role == 6) {
                $newRequestsCount = DemandeChangementStatut::where('statut', 'en_attente')->count();
                $view->with('newRequestsCount', $newRequestsCount);
            }
        });
        Paginator::useBootstrap();
        

    }
    

    
}