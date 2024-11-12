<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementsController extends Controller
{
    public function index()
    {
        $evenements = Evenement::all();
        return view('evenement.index', compact('evenements'));
    }

    public function create()
    {
        return view('evenement.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'adresse' => 'required|string|max:255',
            'elements_requis' => 'required|string',
            'nb_place' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        Evenement::create($validatedData);

        return redirect()->route('evenements.index')
            ->with('success', 'Événement créé avec succès.');
    }

    public function show(Evenement $evenement)
    {
        return view('evenement.show', compact('evenement'));
    }

    public function edit(Evenement $evenement)
    {
        return view('evenement.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'adresse' => 'required|string|max:255',
            'elements_requis' => 'required|string',
            'nb_place' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $evenement->update($validatedData);

        return redirect()->route('evenements.index')
            ->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Evenement $evenement)
    {
        $evenement->delete();

        return redirect()->route('evenements.index')
            ->with('success', 'Événement supprimé avec succès.');
    }
}