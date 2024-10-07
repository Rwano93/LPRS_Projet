<?php

namespace App\Http\Controllers;

use App\Models\Concerne;
use Illuminate\Http\Request;

class ConcerneController extends Controller
{
    public function index()
    {
        $concernes = Concerne::all();
        return view('concernes.index', compact('concernes'));
    }

    public function create()
    {
        return view('concernes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_post' => 'required|exists:posts,id_post',
            'id_reponse' => 'required|exists:reponses,id_reponse',
        ]);

        Concerne::create($validated);
        return redirect()->route('concernes.index')->with('success', 'Lien créé avec succès.');
    }

    public function show(Concerne $concerne)
    {
        return view('concernes.show', compact('concerne'));
    }

    public function edit(Concerne $concerne)
    {
        return view('concernes.edit', compact('concerne'));
    }

    public function update(Request $request, Concerne $concerne)
    {
        $validated = $request->validate([
            'id_post' => 'required|exists:posts,id_post',
            'id_reponse' => 'required|exists:reponses,id_reponse',
        ]);

        $concerne->update($validated);
        return redirect()->route('concernes.index')->with('success', 'Lien mis à jour avec succès.');
    }

    public function destroy(Concerne $concerne)
    {
        $concerne->delete();
        return redirect()->route('concernes.index')->with('success', 'Lien supprimé avec succès.');
    }
}
