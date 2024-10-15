<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AlumniController extends Controller
{
    public function index()
    {
        // Afficher tous les alumni
        $alumni = User::whereHas('roles', function($q) {
            $q->where('name', 'alumni');
        })->get();
        
        return view('alumni.index', compact('alumni'));
    }

    public function create()
    {
        // Retourner la vue pour créer un alumni
        return view('alumni.create');
    }

    public function store(Request $request)
    {
        // Créer un alumni
        $alumni = User::create($request->all());
        $role = Role::where('name', 'alumni')->first();
        $alumni->roles()->attach($role);

        return redirect()->route('alumni.index')->with('success', 'Alumni créé avec succès');
    }

    public function edit($id)
    {
        // Modifier un alumni
        $alumni = User::find($id);
        return view('alumni.edit', compact('alumni'));
    }

    public function update(Request $request, $id)
    {
        // Mettre à jour un alumni
        $alumni = User::find($id);
        $alumni->update($request->all());

        return redirect()->route('alumni.index')->with('success', 'Alumni mis à jour avec succès');
    }

    public function destroy($id)
    {
        // Supprimer un alumni
        $alumni = User::find($id);
        $alumni->delete();

        return redirect()->route('alumni.index')->with('success', 'Alumni supprimé avec succès');
    }
}

