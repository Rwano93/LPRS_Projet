<?php

namespace App\Http\Controllers;

use App\Models\ActualiteAvant;
use App\Models\EvenementAvant;
use App\Models\OffreAvant;

// Contrôleur pour la page d'accueil
class AccueilController
{
    // Méthode pour afficher la page d'accueil
    public function index()
    {
        // Récupération des données pour la page d'accueil
        $events = EvenementAvant::all();
        $news = ActualiteAvant::all();
        $offers = OffreAvant::all();

        // Affichage de la vue dashboard avec les données récupérées
        return view('dashboard', compact('offers', 'news', 'events'));
    }
}