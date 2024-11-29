<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    public function index()
    {
        $offres = Offre::with('entreprise')->get();
        return view('offres.index', compact('offres'));
    }

    public function create()
    {
        return view('offres.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'titre' => 'required|max:255',
            'description' => 'required',
            'missions' => 'required',
            'type' => 'required',
            'salaire' => 'nullable|numeric',
            'entreprise_nom' => 'required|max:255',
            'entreprise_adresse' => 'required|max:255',
            'entreprise_code_postal' => 'required|digits:5',
            'entreprise_ville' => 'required|max:255',
            'entreprise_telephone' => 'required|digits:10',
            'entreprise_site_web' => 'nullable|url', // Ajout de la validation pour l'URL
        ]);

        // Créer ou récupérer l'entreprise
        $entreprise = Entreprise::firstOrCreate(
            ['site_web' => $request->entreprise_site_web],  // Si le site_web est renseigné, l'entreprise sera récupérée sur cette base
            [
                'nom' => $request->entreprise_nom,
                'adresse' => $request->entreprise_adresse,
                'code_postal' => $request->entreprise_code_postal,
                'ville' => $request->entreprise_ville,
                'telephone' => $request->entreprise_telephone,
            ]
        );

        // Créer l'offre d'emploi
        $offre = new Offre([
            'titre' => $request->titre,
            'description' => $request->description,
            'missions' => $request->missions,
            'type' => $request->type,
            'salaire' => $request->salaire,
        ]);

        // Associer l'entreprise à l'offre
        $offre->entreprise()->associate($entreprise);

        // Associer l'utilisateur (authentifié) à l'offre
        $offre->user()->associate(Auth::user());

        // Définir l'état de l'offre comme ouverte
        $offre->est_ouverte = true;

        // Sauvegarder l'offre
        $offre->save();

        // Redirection après la création
        return redirect()->route('offres.index')
            ->with('success', 'Offre d\'emploi créée avec succès.');
    }

    public function show(Offre $offre)
    {
        return view('offres.show', compact('offre'));
    }

    public function edit(Offre $offre)
    {
        $entreprises = Entreprise::all();
        return view('offres.edit', compact('offre', 'entreprises'));
    }

    public function update(Request $request, Offre $offre)
    {
        // Validation des données pour la mise à jour
        $request->validate([
            'titre' => 'required|max:255',
            'description' => 'required',
            'missions' => 'required',
            'type' => 'required|in:CDI,CDD,alternance,stage',
            'salaire' => 'nullable|numeric',
            'entreprise_id' => 'required|exists:entreprises,id', // Vérifie que l'ID de l'entreprise existe
        ]);

        // Mettre à jour l'offre d'emploi
        $offre->update($request->all());

        return redirect()->route('offres.index')
            ->with('success', 'Offre d\'emploi mise à jour avec succès.');
    }

    public function destroy(Offre $offre)
    {
        $offre->delete();

        return redirect()->route('offres.index')
            ->with('success', 'Offre d\'emploi supprimée avec succès.');
    }
}
