<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Evenement;
use App\Models\Actualite;
use App\Models\ActualiteAvant;
use App\Models\EvenementAvant;
use App\Models\OffreAvant;

class AccueilController extends Controller
{
    public function index()
    {

        // Récupération des données pour la page d'accueil
        $events = EvenementAvant::all();
        $news = ActualiteAvant::all();
        $offers = OffreAvant::all();


        // Passer les données à la vue
        return view('home', compact('offers', 'events', 'news'));
    }
}
