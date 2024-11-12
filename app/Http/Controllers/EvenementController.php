<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvenementController extends Controller
{
    public function index(Request $request)
    {
        $query = Evenement::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('titre', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $evenements = $query->latest()->paginate(15);

        return view('evenements.index', compact('evenements'));
    }

    public function show(Evenement $evenement)
    {
        return view('evenements.show', compact('evenement'));
    }

    public function create()
    {
        return view('evenements.create');
    }

    public function edit(Evenement $evenement)
    {
        return view('evenements.edit', compact('evenement'));
    }

    public function inscription(Evenement $evenement)
    {
        if ($evenement->places_disponibles > 0 && !$evenement->isUserInscrit(Auth::id())) {
            $evenement->participants()->attach(Auth::id());
            $evenement->decrement('places_disponibles');
            return response()->json(['success' => true, 'message' => 'Inscription réussie !']);
        }
        return response()->json(['success' => false, 'message' => 'Inscription impossible.'], 422);
    }

    public function desinscription(Evenement $evenement)
    {
        if ($evenement->isUserInscrit(Auth::id())) {
            $evenement->participants()->detach(Auth::id());
            $evenement->increment('places_disponibles');
            return response()->json(['success' => true, 'message' => 'Désinscription réussie !']);
        }
        return response()->json(['success' => false, 'message' => 'Désinscription impossible.'], 422);
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'titre' => 'required|max:255',
        'description' => 'required',
        'date' => 'required|date',
        'lieu' => 'required|max:255',
        'places_disponibles' => 'required|integer|min:1',
    ]);

    $validatedData['user_id'] = Auth::id();

    $evenement = Evenement::create($validatedData);

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Événement créé avec succès !',
            'evenement' => $evenement 
        ]);
    }

    return redirect()->route('evenements.index')->with('success', 'Événement créé avec succès !');
}

    public function update(Request $request, Evenement $evenement)
    {
        $validatedData = $request->validate([
            'titre' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'lieu' => 'required|max:255',
            'places_disponibles' => 'required|integer|min:1',
        ]);

        $evenement->update($validatedData);

        return response()->json(['success' => true, 'message' => 'Événement mis à jour avec succès !', 'evenement' => $evenement]);
    }

    public function destroy(Evenement $evenement)
    {
        try {
            $evenement->delete();
            return response()->json([
                'success' => true,
                'message' => 'Événement supprimé avec succès !'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de l\'événement.'
            ], 500);
        }
    }
}