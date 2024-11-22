<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EvenementAvantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\DemandeChangementStatutController;
use App\Http\Controllers\GestionnaireController;
use App\Http\Middleware\GestionnaireMiddleware;



//Route::resource('evenement', EvenementController::class); // Commencez pas a toucher bettement... 
Route::middleware(['auth'])->group(function () {
    Route::get('/evenements', [EvenementController::class, 'index'])->name('evenement.index');
    Route::get('/evenements/create', [EvenementController::class, 'create'])->name('evenement.create');
    Route::post('/evenements', [EvenementController::class, 'store'])->name('evenement.store');
    Route::get('/evenements/{evenement}/edit', [EvenementController::class, 'edit'])->name('evenement.edit');
    Route::get('/evenements/{evenement}', [EvenementController::class, 'show'])->name('evenement.show');
    Route::put('/evenements/{evenement}', [EvenementController::class, 'update'])->name('evenement.update');
    Route::delete('/evenements/{evenement}', [EvenementController::class, 'destroy'])->name('evenement.destroy');
    Route::post('/evenements/{evenement}/inscription', [EvenementController::class, 'inscription'])->name('evenement.inscription');
    Route::delete('/evenements/{evenement}/desinscription', [EvenementController::class, 'desinscription'])->name('evenement.desinscription');
    Route::get('/evenements/{evenement}/inscrits', [EvenementController::class, 'inscrits'])->name('evenement.inscrits');
    Route::delete('/evenements/{evenement}/users/{user}', [EvenementController::class, 'removeUserFromEvent'])->name('evenement.removeUserFromEvent');
});
Route::delete('/evenements/{evenement}/users/{user}', [EvenementController::class, 'removeUserFromEvent'])
    ->name('evenement.removeUserFromEvent');


Route::get('/', [EvenementAvantController::class, 'index'])->name('home');
Route::get('/dashboard', [EvenementAvantController::class, 'index'])->name('dashboard');
//Actualités
Route::middleware(['auth'])->group(function () {
    Route::resource('actualites', ActualiteController::class);
});

//Route pour Users Controle
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('users', UserController::class);
});
//Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/contact/confirmation', [ContactController::class, 'confirmation'])->name('contact.confirmation');


//Route pour JOB OFFER
Route::resource('offres', OffreController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
    Route::post('/offres', [OffreController::class, 'store'])->name('offres.store');
    Route::put('/offres/{offre}', [OffreController::class, 'update'])->name('offres.update');
    Route::delete('/offres/{offre}', [OffreController::class, 'destroy'])->name('offres.destroy');
});


// Routes pour les demandes de changement de statut (accessibles à tous les utilisateurs authentifiés)
Route::middleware(['auth'])->group(function () {
    Route::get('/demandes/create', [DemandeChangementStatutController::class, 'create'])->name('demandes.create');
    Route::post('/demandes', [DemandeChangementStatutController::class, 'store'])->name('demandes.store');
});

Route::middleware(['auth', GestionnaireMiddleware::class])->group(function () {
    Route::get('/gestionnaire/dashboard', [GestionnaireController::class, 'dashboard'])->name('gestionnaire.dashboard');
    Route::get('/gestionnaire/demandes', [GestionnaireController::class, 'gererDemandes'])->name('gestionnaire.demandes.index');
    Route::get('/gestionnaire/demandes/{demande}', [GestionnaireController::class, 'voirDemande'])->name('gestionnaire.demandes.show');
    Route::post('/gestionnaire/demandes/{demande}/approuver', [GestionnaireController::class, 'approuverDemande'])->name('gestionnaire.demandes.approuver');
    Route::post('/gestionnaire/demandes/{demande}/rejeter', [GestionnaireController::class, 'rejeterDemande'])->name('gestionnaire.demandes.rejeter');

    // Statistiques (optionnel)
    Route::get('/gestionnaire/statistiques', [GestionnaireController::class, 'statistiques'])->name('gestionnaire.statistiques');
});


// Route Dahsboard
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});






