<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EvenementAvantController;


//Route::resource('evenement', EvenementController::class); // Commencez pas a toucher bettement... 
Route::middleware(['auth'])->group(function () {
    Route::get('/evenements', [EvenementController::class, 'index'])->name('evenement.index');
    Route::get('/evenements/create', [EvenementController::class, 'create'])->name('evenement.create');
    Route::post('/evenements', [EvenementController::class, 'store'])->name('evenement.store');
    Route::get('/evenements/{evenement}/edit', [EvenementController::class, 'edit'])->name('evenement.edit');
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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


