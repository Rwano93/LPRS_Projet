<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class EtudiantController extends Controller
{
    public function index()
    {
        // Afficher tous les étudiants
        $etudiants = User::whereHas('roles', function($q) {
            $q->where('name', 'etudiant');
        })->get();
        
        return view('etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        // Retourner la vue pour créer un étudiant
        return view('etudiants.create');
    }

    public function store(Request $request)
    {
        // Créer un étudiant
        $etudiant = User::create($request->all());
        $role = Role::where('name', 'etudiant')->first();
        $etudiant->roles()->attach($role);

        return redirect()->route('etudiants.index')->with('success', 'Étudiant créé avec succès');
    }

    public function edit($id)
    {
        // Modifier un étudiant
        $etudiant = User::find($id);
        return view('etudiants.edit', compact('etudiant'));
    }

    public function update(Request $request, $id)
    {
        // Mettre à jour un étudiant
        $etudiant = User::find($id);
        $etudiant->update($request->all());

        return redirect()->route('etudiants.index')->with('success', 'Étudiant mis à jour avec succès');
    }

    public function destroy($id)
    {
        // Supprimer un étudiant
        $etudiant = User::find($id);
        $etudiant->delete();

        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès');
    }
}
