<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActualiteController extends Controller
{
    public function index()
    {
        $actualites = Actualite::orderBy('date_publication', 'desc')->paginate(10);
        return view('actualites.index', compact('actualites'));
    }

    public function create()
    {
        return view('actualites.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|max:255',
            'contenu' => 'required',
            'date_publication' => 'required|date',
            'image_url' => 'nullable|url',
        ]);

        $actualite = new Actualite($validatedData);
        $actualite->user_id = Auth::id();
        $actualite->save();

        return redirect()->route('actualites.index')->with('success', 'Actualité créée avec succès.');
    }

    public function show(Actualite $actualite)
    {
        return view('actualites.show', compact('actualite'));
    }

    public function edit(Actualite $actualite)
    {
        return view('actualites.edit', compact('actualite'));
    }

    public function update(Request $request, Actualite $actualite)
    {
        $validatedData = $request->validate([
            'titre' => 'required|max:255',
            'contenu' => 'required',
            'date_publication' => 'required|date',
            'image_url' => 'nullable|url',
        ]);

        $actualite->update($validatedData);

        return redirect()->route('actualites.index')->with('success', 'Actualité mise à jour avec succès.');
    }

    public function destroy(Actualite $actualite)
    {
        $actualite->delete();
        return redirect()->route('actualites.index')->with('success', 'Actualité supprimée avec succès.');
    }
}