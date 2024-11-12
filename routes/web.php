<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;

// Evenement

Route::resource('evenements', EvenementController::class);
Route::post('/evenements/{evenement}/inscription', [EvenementController::class, 'inscription'])->name('evenements.inscription');
Route::delete('/evenements/{evenement}/desinscription', [EvenementController::class, 'desinscription'])->name('evenements.desinscription');

// ...
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


