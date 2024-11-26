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
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ReplyController;


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

// Forum et discussions
Route::get('/forum', [DiscussionController::class, 'index'])->name('forum.index'); // Page principale du forum
Route::get('/discussions/create', [DiscussionController::class, 'create'])->name('discussions.create'); // Formulaire de création
Route::post('/discussions', [DiscussionController::class, 'store'])->name('discussions.store'); // Sauvegarde de la discussion
Route::resource('discussions', DiscussionController::class)->except(['index', 'create', 'store']);
Route::resource('discussions', DiscussionController::class);
Route::resource('replies', ReplyController::class);
Route::post('/replies', [ReplyController::class, 'store'])->name('replies.store');
Route::get('/discussions/image/{id}', [DiscussionController::class, 'displayImage'])->name('discussions.image');
Route::post('/discussions/{discussion}/replies', [ReplyController::class, 'store'])->name('replies.store');
Route::post('/discussions/{discussion}/replies', [ReplyController::class, 'store'])->name('replies.store');
Route::resource('discussions', DiscussionController::class);
Route::post('/discussions/{discussion}/replies', [ReplyController::class, 'store'])->name('replies.store');

// Ajout de routes RESTful pour Discussions
Route::resource('discussions', DiscussionController::class);
Route::get('/discussions', [DiscussionController::class, 'index'])->name('discussion.index');

Route::get('/', [EvenementAvantController::class, 'index'])->name('home');
Route::get('/dashboard', [EvenementAvantController::class, 'index'])->name('dashboard');

// Routes pour les actualités
Route::middleware(['auth'])->group(function () {
    Route::resource('actualites', ActualiteController::class);
});

// Routes pour le contrôle des utilisateurs
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('users', UserController::class);
});

// Routes pour le contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/contact/confirmation', [ContactController::class, 'confirmation'])->name('contact.confirmation');

// Routes pour les offres d'emploi
Route::resource('offres', OffreController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
    Route::post('/offres', [OffreController::class, 'store'])->name('offres.store');
    Route::put('/offres/{offre}', [OffreController::class, 'update'])->name('offres.update');
    Route::delete('/offres/{offre}', [OffreController::class, 'destroy'])->name('offres.destroy');
});

// Routes pour les demandes de changement de statut
Route::middleware(['auth'])->group(function () {
    Route::get('/demandes', [DemandeChangementStatutController::class, 'index'])->name('demandes.index');
    Route::get('/demandes/create/etudiant', [DemandeChangementStatutController::class, 'createEtudiant'])->name('demandes.create.etudiant');
    Route::get('/demandes/create/professeur', [DemandeChangementStatutController::class, 'createProfesseur'])->name('demandes.create.professeur');
    Route::get('/demandes/create/alumni', [DemandeChangementStatutController::class, 'createAlumni'])->name('demandes.create.alumni');
    Route::get('/demandes/create/entreprise', [DemandeChangementStatutController::class, 'createEntreprise'])->name('demandes.create.entreprise');
    Route::post('/demandes', [DemandeChangementStatutController::class, 'store'])->name('demandes.store');
});

    Route::middleware(['role:Gestionnaire'])->group(function () {
        Route::get('/gestionnaire/demandes', [DemandeChangementStatutController::class, 'index'])->name('gestionnaire.demandes.index');
        Route::get('/gestionnaire/demandes/{demande}', [DemandeChangementStatutController::class, 'show'])->name('gestionnaire.demandes.show');
        Route::post('/gestionnaire/demandes/{demande}/approuver', [DemandeChangementStatutController::class, 'approuver'])->name('gestionnaire.demandes.approuver');
        Route::post('/gestionnaire/demandes/{demande}/rejeter', [DemandeChangementStatutController::class, 'rejeter'])->name('gestionnaire.demandes.rejeter');
 });

// Routes pour le gestionnaire
Route::middleware(['auth', GestionnaireMiddleware::class])->group(function () {
    Route::get('/gestionnaire/dashboard', [GestionnaireController::class, 'dashboard'])->name('gestionnaire.dashboard');
    Route::get('/gestionnaire/demandes', [GestionnaireController::class, 'gererDemandes'])->name('gestionnaire.demandes.index');
    Route::get('/gestionnaire/demandes/{demande}', [GestionnaireController::class, 'voirDemande'])->name('gestionnaire.demandes.show');
    Route::post('/gestionnaire/demandes/{demande}/approuver', [GestionnaireController::class, 'approuverDemande'])->name('gestionnaire.demandes.approuver');
    Route::post('/gestionnaire/demandes/{demande}/rejeter', [GestionnaireController::class, 'rejeterDemande'])->name('gestionnaire.demandes.rejeter');
    Route::get('/gestionnaire/statistiques', [GestionnaireController::class, 'statistiques'])->name('gestionnaire.statistiques');
});

// Route pour le tableau de bord
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});