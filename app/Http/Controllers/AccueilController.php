<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Offre;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function index()
{
    

    $evenements = Evenement::orderBy('date', 'desc')->take(3)->get();
    $offres = Offre::with('entreprise')->orderBy('created_at', 'desc')->take(3)->get();

    return view('dashboard', compact('evenements', 'offres'));
}
}
