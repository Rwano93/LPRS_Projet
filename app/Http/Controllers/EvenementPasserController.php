<?php

namespace App\Http\Controllers;

use App\Models\EvenementPasser;
use Illuminate\Http\Request;

class EvenementPasserController extends Controller
{
    public function index()
    {
        $evenementAvants = EvenementPasser::with([
            'evenement' => function ($query) {
                $query->where('date', '>=', now());
            }
        ])
            ->whereHas('evenement', function ($query) {
                $query->where('date', '>=', now());
            })
            ->take(4)
            ->get();

        // Vous pouvez ajouter ici d'autres données pour les offres, etc.
        // $offres = Offre::latest()->take(3)->get();

        return view('dashboard', compact('evenementAvants'));
    }
}