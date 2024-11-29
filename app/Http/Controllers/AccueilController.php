<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Evenement;
use App\Models\Actualite;

class AccueilController extends Controller
{
    public function index()
    {
        // Exemple pour récupérer les données de tes offres, événements et actualités
        $offers = Offre::with('offre')->latest()->take(3)->get(); // Assurez-vous que la relation 'offre' existe
        $events = Evenement::with('evenement')->latest()->take(3)->get(); // Assurez-vous que la relation 'evenement' existe
        $news = Actualite::latest()->take(3)->get(); // Assurez-vous qu'il n'y a pas de relation spécifique ici

        // Passer les données à la vue
        return view('home', compact('offers', 'events', 'news'));
    }
}
