<?php

namespace App\Http\Controllers;

use App\Models\Publier;
use Illuminate\Http\Request;

class PublierController extends Controller
{
    public function index()
    {
        $publis = Publier::all();
        return view('publier.index', compact('publis'));
    }

    public function create()
    {
        return view('publier.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_utilisateur' => 'required|exists:users,id',
            'id_offre' => 'required|exists:offres,id_offre',
        ]);

        Publier::create($validated);
        return redirect()->route('publier.index')->with('success', 'Publication ajoutée avec succès.');
    }

    public function show(Publier $publier)
    {
        return view('publier.show', compact('publier'));
    }

    public function edit(Publier $publier)
    {
        return view('publier.edit', compact('publier'));
    }

    public function update(Request $request, Publier $publier)
    {
        $validated = $request->validate([
            'id_utilisateur' => 'required|exists:users,id',
            'id_offre' => 'required|exists:offres,id_offre',
        ]);

        $publier->update($validated);
        return redirect()->route('publier.index')->with('success', 'Publication mise à jour avec succès.');
    }

    public function destroy(Publier $publier)
    {
        $publier->delete();
        return redirect()->route('publier.index')->with('success', 'Publication supprimée avec succès.');
    }
}
