<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    public function index()
    {
        $offres = Offre::all();
        return view('offres.index', compact('offres'));
    }

    public function create()
    {
        return view('offres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'CV' => 'nullable|string',
            'description' => 'required|string',
            'type' => 'required|in:stage,CDD,CDI',
            'etat' => 'required|in:ouverte,clôturée',
            'id_entreprise' => 'nullable|exists:fiche_entreprises,id_entreprise',
        ]);

        Offre::create($validated);
        return redirect()->route('offres.index')->with('success', 'Offre créée avec succès.');
    }

    public function show(Offre $offre)
    {
        return view('offres.show', compact('offre'));
    }

    public function edit(Offre $offre)
    {
        return view('offres.edit', compact('offre'));
    }

    public function update(Request $request, Offre $offre)
    {
        $validated = $request->validate([
            'CV' => 'nullable|string',
            'description' => 'required|string',
            'type' => 'required|in:stage,CDD,CDI',
            'etat' => 'required|in:ouverte,clôturée',
            'id_entreprise' => 'nullable|exists:fiche_entreprises,id_entreprise',
        ]);

        $offre->update($validated);
        return redirect()->route('offres.index')->with('success', 'Offre mise à jour avec succès.');
    }

    public function destroy(Offre $offre)
    {
        $offre->delete();
        return redirect()->route('offres.index')->with('success', 'Offre supprimée avec succès.');
    }
}
