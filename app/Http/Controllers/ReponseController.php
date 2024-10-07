<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use Illuminate\Http\Request;

class ReponseController extends Controller
{
    public function index()
    {
        $reponses = Reponse::all();
        return view('reponses.index', compact('reponses'));
    }

    public function create()
    {
        return view('reponses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contenue' => 'required|string',
            'date_reponse' => 'required|date',
            'id_post' => 'required|exists:posts,id_post',
        ]);

        Reponse::create($validated);
        return redirect()->route('reponses.index')->with('success', 'Réponse créée avec succès.');
    }

    public function show(Reponse $reponse)
    {
        return view('reponses.show', compact('reponse'));
    }

    public function edit(Reponse $reponse)
    {
        return view('reponses.edit', compact('reponse'));
    }

    public function update(Request $request, Reponse $reponse)
    {
        $validated = $request->validate([
            'contenue' => 'required|string',
            'date_reponse' => 'required|date',
            'id_post' => 'required|exists:posts,id_post',
        ]);

        $reponse->update($validated);
        return redirect()->route('reponses.index')->with('success', 'Réponse mise à jour avec succès.');
    }

    public function destroy(Reponse $reponse)
    {
        $reponse->delete();
        return redirect()->route('reponses.index')->with('success', 'Réponse supprimée avec succès.');
    }
}
