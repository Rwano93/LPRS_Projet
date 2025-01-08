<?php

use App\Http\Middleware\OffreMiddleware;
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
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\FileController;
use App\Mail\HelloMail;
use App\Http\Middleware\EntrepriseAlumni;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ForumController;
use App\Http\Middleware\ProfesseurMiddleware;
use App\Http\Controllers\CandidatureController;



Route::get('/', [AccueilController::class, 'index'])->name('dashboard');

//Route::resource('evenement', EvenementController::class); // Commencez pas a toucher bettement...
Route::middleware(['auth', OffreMiddleware::class])->group(function () {
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

    
Route::middleware(['auth', ProfesseurMiddleware::class])->group(function () {
    Route::get('/approbation/demandes', [EvenementController::class, 'demandes'])->name('approbation.demandes');
    Route::patch('/approbation/demandes/{demande}/approuver', [EvenementController::class, 'approuverDemande'])->name('evenement.approuverDemande');
    Route::patch('/approbation/demandes/{demande}/refuser', [EvenementController::class, 'refuserDemande'])->name('evenement.refuserDemande');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/discussions', [DiscussionController::class, 'index'])->name('discussions.index');
    Route::post('/discussions', [DiscussionController::class, 'store'])->name('discussions.store');
    Route::get('/discussions/create', [DiscussionController::class, 'create'])->name('discussions.create');
    Route::get('/discussions/{discussion}', [DiscussionController::class, 'show'])->name('discussions.show');
    Route::delete('/discussions/{discussion}', [DiscussionController::class, 'destroy'])->name('discussions.destroy');
    Route::get('/discussions/{discussion}/edit', [DiscussionController::class, 'edit'])->name('discussions.edit');
    Route::put('/discussions/{discussion}', [DiscussionController::class, 'update'])->name('discussions.update');
    Route::get('/discussions/{discussion}/replies/{reply}', [ReplyController::class, 'edit'])->name('replies.edit');
    Route::put('/discussions/{discussion}/replies/{reply}', [ReplyController::class, 'update'])->name('replies.update');
    Route::delete('/discussions/{discussion}/replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.destroy');
    
});

    
// Routes pour les actualités
Route::middleware(['auth'])->group(function () {
    Route::resource('actualites', ActualiteController::class);
});

// Routes pour le contrôle des utilisateurs
Route::middleware(['auth', GestionnaireMiddleware::class])->group(function () {
    Route::resource('users', UserController::class);
});

// Routes pour le contact
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/contact/success', [ContactController::class, 'success'])->name('contact.success');


// Routes pour les offres d'emploi
Route::middleware(['auth', OffreMiddleware::class])->group(function () {
Route::resource('offres', OffreController::class);
    Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
    Route::post('/offres', [OffreController::class, 'store'])->name('offres.store');
    Route::put('/offres/{offre}', [OffreController::class, 'update'])->name('offres.update');
    Route::delete('/offres/{offre}', [OffreController::class, 'destroy'])->name('offres.destroy');
    Route::post('/offres/{offre}/postuler', [OffreController::class, 'postuler'])->name('offres.postuler');
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


// Routes pour le gestionnaire
Route::middleware(['auth', GestionnaireMiddleware::class])->group(function () {
    Route::get('/gestionnaire/dashboard', [GestionnaireController::class, 'dashboard'])->name('gestionnaire.dashboard');
    Route::get('/gestionnaire/demandes', [GestionnaireController::class, 'gererDemandes'])->name('gestionnaire.demandes.index');
    Route::get('/gestionnaire/demandes/{demande}', [GestionnaireController::class, 'voirDemande'])->name('gestionnaire.demandes.show');
    Route::post('/gestionnaire/demandes/{demande}/approuver', [GestionnaireController::class, 'approuverDemande'])->name('gestionnaire.demandes.approuver');
    Route::post('/gestionnaire/demandes/{demande}/rejeter', [GestionnaireController::class, 'rejeterDemande'])->name('gestionnaire.demandes.rejeter');
    Route::get('/gestionnaire/statistiques', [GestionnaireController::class, 'statistiques'])->name('gestionnaire.statistiques');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/reply', [ReplyController::class, 'store'])->name('replies.store');
});

Route::middleware(['auth', EntrepriseAlumni::class])->group(function () {
    Route::resource('entreprises', EntrepriseController::class);
    Route::post('/entreprises/{entreprise}/request-link', [EntrepriseController::class, 'requestLink'])->name('entreprises.request-link');
    Route::patch('/entreprises/verify-link/{pivotId}', [EntrepriseController::class, 'verifyLink'])->name('entreprises.verify-link');
    Route::patch('/entreprises/{entreprise}/approve-partnership', [EntrepriseController::class, 'approvePartnership'])->name('entreprises.approve-partnership');
    Route::patch('/entreprises/{entreprise}/reject-partnership', [EntrepriseController::class, 'rejectPartnership'])->name('entreprises.reject-partnership');


});


Route::get('cv/{filename}', [FileController::class, 'serveFile'])->name('serve.cv');

// Route pour le tableau de bord
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AccueilController::class, 'index'])->name('dashboard');

});
Route::get('/offres/{offre}/candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');
Route::post('/candidatures/{candidature}/accepter', [CandidatureController::class, 'accepter'])->name('candidatures.accepter');
Route::post('/candidatures/{candidature}/refuser', [CandidatureController::class, 'refuser'])->name('candidatures.refuser');
Route::get('/offres/{offre}/candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');
