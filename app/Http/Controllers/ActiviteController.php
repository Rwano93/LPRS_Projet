<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiviteController extends Controller
{
    // Afficher la liste des activités
    public function index()
    {
        // Récupère toutes les activités
        $activites = Activite::all();

        // Retourne la vue avec les données des activités
        return view('activite.index', compact('activites'));
    }

    // Afficher le formulaire de création d'une activité
    public function create()
    {
        // Récupère tous les utilisateurs pour les associer à l'activité si nécessaire
        $users = User::all();

        // Retourne la vue avec les utilisateurs
        return view('activite.create', compact('users'));
    }

    // Stocker une nouvelle activité
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'date' => 'required|date_format:Y-m-d\TH:i',
            'nb_place' => 'required|integer|min:1',
        ]);

        // Crée une nouvelle instance d'activité
        $activite = new Activite();
        $activite->titre = $validatedData['titre'];
        $activite->desc = $validatedData['desc'];
        $activite->date = $validatedData['date'];
        $activite->nb_place = $validatedData['nb_place'];

        // Associe l'utilisateur connecté à l'activité
        $activite->ref_user = Auth::id();  // Récupère l'ID de l'utilisateur connecté

        // Sauvegarde l'activité dans la base de données
        $activite->save();

        // Redirige vers la liste des activités avec un message de succès
        return redirect()->route('activite.index')->with('success', 'Activité créée avec succès.');
    }

    // Afficher une activité spécifique
    public function show(Activite $activite)
    {
        // Retourne la vue avec l'activité spécifique
        return view('activite.show', compact('activite'));
    }

    // Afficher le formulaire d'édition d'une activité
    public function edit(Activite $activite)
    {
        // Retourne la vue d'édition avec l'activité existante
        return view('activite.edit', compact('activite'));
    }

    // Mettre à jour une activité
    public function update(Request $request, Activite $activite)
    {
        // Validation des nouvelles données
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'desc' => 'required|string',
            'date' => 'required|date_format:Y-m-d\TH:i',
            'nb_place' => 'required|integer|min:1',
        ]);

        // Met à jour les informations de l'activité
        $activite->update($validatedData);

        // Redirige vers la liste des activités avec un message de succès
        return redirect()->route('activite.index')
            ->with('success', 'Activité mise à jour avec succès.');
    }

    // Supprimer une activité
    public function destroy(Activite $activite)
    {
        // Supprime l'activité de la base de données
        $activite->delete();

        // Redirige vers la liste des activités avec un message de succès
        return redirect()->route('activite.index')
            ->with('success', 'Activité supprimée avec succès.');
    }
}
