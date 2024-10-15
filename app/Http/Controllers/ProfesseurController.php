<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class ProfesseurController extends Controller
{
    public function index()
    {
        // Afficher tous les professeurs
        $professeurs = User::whereHas('roles', function($q) {
            $q->where('name', 'professeur');
        })->get();
        
        return view('professeurs.index', compact('professeurs'));
    }

    public function create()
    {
        // Retourner la vue pour créer un professeur
        return view('professeurs.create');
    }

    public function store(Request $request)
    {
        // Créer un professeur
        $professeur = User::create($request->all());
        $role = Role::where('name', 'professeur')->first();
        $professeur->roles()->attach($role);

        return redirect()->route('professeurs.index')->with('success', 'Professeur créé avec succès');
    }

    public function edit($id)
    {
        // Modifier un professeur
        $professeur = User::find($id);
        return view('professeurs.edit', compact('professeur'));
    }

    public function update(Request $request, $id)
    {
        // Mettre à jour un professeur
        $professeur = User::find($id);
        $professeur->update($request->all());

        return redirect()->route('professeurs.index')->with('success', 'Professeur mis à jour avec succès');
    }

    public function destroy($id)
    {
        // Supprimer un professeur
        $professeur = User::find($id);
        $professeur->delete();

        return redirect()->route('professeurs.index')->with('success', 'Professeur supprimé avec succès');
    }
}
