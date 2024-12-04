<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrepriseController extends Controller
{
    public function create()
    {
        return view('entreprises.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string|size:5',
            'ville' => 'required|string|max:255',
            'telephone' => 'required|string|size:10',
            'site_web' => 'required|url|unique:entreprises',
            'poste' => 'required|string|max:255',
            'motif_inscription' => 'nullable|required_if:user_type,alumni|string|max:1000',
        ]);

        $entreprise = Entreprise::create([
            'nom' => $validated['nom'],
            'adresse' => $validated['adresse'],
            'code_postal' => $validated['code_postal'],
            'ville' => $validated['ville'],
            'telephone' => $validated['telephone'],
            'site_web' => $validated['site_web'],
        ]);

        $pivotData = [
            'poste' => $validated['poste'],
        ];

        if (Auth::user()->role->libelle === 'Alumni') {
            $pivotData['motif_inscription'] = $validated['motif_inscription'];
        }

        Auth::user()->entreprises()->attach($entreprise->id, $pivotData);

        return redirect()->route('dashboard')
            ->with('success', 'Entreprise créée et rattachée avec succès.');
    }

    public function attach(Request $request)
    {
        $validated = $request->validate([
            'entreprise_id' => 'required|exists:entreprises,id',
            'poste' => 'required|string|max:255',
            'motif_inscription' => 'nullable|required_if:user_type,alumni|string|max:1000',
        ]);

        $pivotData = [
            'poste' => $validated['poste'],
        ];

        if (Auth::user()->role->libelle === 'Alumni') {
            $pivotData['motif_inscription'] = $validated['motif_inscription'];
        }

        Auth::user()->entreprises()->attach($validated['entreprise_id'], $pivotData);

        return redirect()->route('dashboard')
            ->with('success', 'Rattachement à l\'entreprise effectué avec succès.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $entreprises = Entreprise::where('nom', 'like', "%{$query}%")
            ->orWhere('site_web', 'like', "%{$query}%")
            ->get();

        return response()->json($entreprises);
    }
}