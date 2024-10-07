<?php

namespace App\Http\Controllers;

use App\Models\FicheEntreprise;
use Illuminate\Http\Request;

class FicheEntrepriseController extends Controller
{
    public function index()
    {
        $entreprises = FicheEntreprise::all();
        return view('entreprises.index', compact('entreprises'));
    }

    public function create()
    {
        return view('entreprises.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'rue' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:10',
            'ville' => 'nullable|string|max:100',
        ]);

        FicheEntreprise::create($validated);
        return redirect()->route('entreprises.index')->with('success', 'Entreprise créée avec succès.');
    }

    public function show(FicheEntreprise $entreprise)
    {
        return view('entreprises.show', compact('entreprise'));
    }

    public function edit(FicheEntreprise $entreprise)
    {
        return view('entreprises.edit', compact('entreprise'));
    }

    public function update(Request $request, FicheEntreprise $entreprise)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'rue' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:10',
            'ville' => 'nullable|string|max:100',
        ]);

        $entreprise->update($validated);
        return redirect()->route('entreprises.index')->with('success', 'Entreprise mise à jour avec succès.');
    }

    public function destroy(FicheEntreprise $entreprise)
    {
        $entreprise->delete();
        return redirect()->route('entreprises.index')->with('success', 'Entreprise supprimée avec succès.');
    }
}
