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
        $request->validate([
            'titre' => 'required',
            'type' => 'required|in:CDI,CDD,alternance,stage',
            'description' => 'required',
        ]);

        Offre::create($request->all());

        return redirect()->route('offres.index')
            ->with('success', 'Offre d\'emploi créée avec succès.');
    }

    public function show(Offre $offre)
    {
        return view('offres.show', compact('offre'));
    }
}