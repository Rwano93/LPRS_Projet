<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AlumniController;


Route::group(['middleware' => ['role:etudiant']], function () {
    Route::get('/etudiant-dashboard', [EtudiantController::class, 'index']);
});

Route::group(['middleware' => ['role:professeur']], function () {
    Route::get('/prof-dashboard', [ProfesseurController::class, 'index']);
});

Route::group(['middleware' => ['role:alumni']], function () {
    Route::get('/alumni-dashboard', [AlumniController::class, 'index']);
});
Route::group(['middleware' => ['role:company']], function () {
    Route::get('/alumni-dashboard', [CompanyController::class, 'index']);
});
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/alumni-dashboard', [AlumniController::class, 'index']);
});




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
