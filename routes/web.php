<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;

// Evenement

Route::resource('evenements', EvenementController::class);
Route::post('/evenements/{evenement}/inscrire', [EvenementController::class, 'inscrire'])->name('evenements.inscrire');
Route::delete('/evenements/{evenement}/desinscrire', [EvenementController::class, 'desinscrire'])->name('evenements.desinscrire');
Route::get('/evenements/{evenement}/gerer-inscriptions', [EvenementController::class, 'gererInscriptions'])->name('evenements.gerer-inscriptions');
Route::delete('/evenements/{evenement}/refuser-inscription/{user}', [EvenementController::class, 'refuserInscription'])->name('evenements.refuser-inscription');
// ...
Route::get('/', function () {
    return view('welcome');
});


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


