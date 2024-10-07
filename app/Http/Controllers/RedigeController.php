<?php

namespace App\Http\Controllers;

use App\Models\Redige;
use Illuminate\Http\Request;

class RedigeController extends Controller
{
    public function index()
    {
        $rediges = Redige::all();
        return view('rediges.index', compact('rediges'));
    }

    public function create()
    {
        return view('rediges.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_utilisateur' => 'required|exists:users,id',
            'id_post' => 'required|exists:posts,id_post',
        ]);

        Redige::create($validated);
        return redirect()->route('rediges.index')->with('success', 'Rédaction ajoutée avec succès.');
    }

    public function show(Redige $redige)
    {
        return view('rediges.show', compact('redige'));
    }

    public function edit(Redige $redige)
    {
        return view('rediges.edit', compact('redige'));
    }

    public function update(Request $request, Redige $redige)
    {
        $validated = $request->validate([
            'id_utilisateur' => 'required|exists:users,id',
            'id_post' => 'required|exists:posts,id_post',
        ]);

        $redige->update($validated);
        return redirect()->route('rediges.index')->with('success', 'Rédaction mise à jour avec succès.');
    }

    public function destroy(Redige $redige)
    {
        $redige->delete();
        return redirect()->route('rediges.index')->with('success', 'Rédaction supprimée avec succès.');
    }
}
