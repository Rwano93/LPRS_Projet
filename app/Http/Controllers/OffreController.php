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
        $request->validate([
            'titre' => 'required|string|max:255',
            'type' => 'required|in:stage,alternance,CDD,CDI',
            'description' => 'required|string',
            'missions' => 'required|string',
            'salaire' => 'nullable|numeric|min:0',
            'entreprise_nom' => 'required|string|max:255',
            'entreprise_adresse' => 'required|string|max:255',
            'entreprise_code_postal' => 'required|digits:5',
            'entreprise_ville' => 'required|string|max:255',
            'entreprise_telephone' => 'required|digits:10',
            'entreprise_site_web' => 'required|url|unique:entreprises,site_web',
        ]);

        // Create or find the company
        $entreprise = Entreprise::firstOrCreate(
            ['site_web' => $request->entreprise_site_web],
            [
                'nom' => $request->entreprise_nom,
                'adresse' => $request->entreprise_adresse,
                'code_postal' => $request->entreprise_code_postal,
                'ville' => $request->entreprise_ville,
                'telephone' => $request->entreprise_telephone,
            ]
        );

        // Create the job offer
        $offre = new Offre([
            'titre' => $request->titre,
            'description' => $request->description,
            'missions' => $request->missions,
            'type' => $request->type,
            'salaire' => $request->salaire,
        ]);

        $offre->entreprise()->associate($entreprise);
        $offre->user()->associate(Auth::user());
        $offre->est_ouverte = true;
        $offre->save();

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
        $request->validate([
            'titre' => 'required',
            'type' => 'required|in:CDI,CDD,alternance,stage',
            'description' => 'required',
            'missions' => 'required',
            'salaire' => 'nullable|numeric',
            'entreprise_id' => 'required|exists:entreprises,id',
        ]);

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