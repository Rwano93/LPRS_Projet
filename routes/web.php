<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;

// Evenement

Route::get('evenements', [EvenementController::class, 'index'])->name('evenements.index');
Route::get('evenements/create', [EvenementController::class, 'create'])->name('evenements.create');
Route::post('evenements/store', [EvenementController::class, 'store'])->name('evenements.store');
Route::get('evenements/{evenement}/edit', [EvenementController::class, 'edit'])->name('evenements.edit');
Route::put('evenements/{evenement}', [EvenementController::class, 'update'])->name('evenements.update');
Route::delete('evenements/{evenement}', [EvenementController::class, 'destroy'])->name('evenements.destroy');
Route::post('/evenements/{evenement}/inscription', [EvenementController::class, 'inscription'])->name('evenements.inscription');
Route::post('/evenements/{evenement}/inscription', [EvenementController::class, 'inscription'])->name('evenements.inscription');
Route::delete('/evenements/{evenement}/desinscription', [EvenementController::class, 'desinscription'])->name('evenements.desinscription');

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


