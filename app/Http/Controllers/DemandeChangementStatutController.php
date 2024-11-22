<?php

namespace App\Http\Controllers;

use App\Models\DemandeChangementStatut;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DemandeChangementStatutController extends Controller
{
    public function create()
    {
        $formations = Formation::all();
        return view('demandes.create', compact('formations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_demande' => 'required|in:Etudiant,Professeur,Alumni,Entreprise',
            'message' => 'required|string',
            'cv' => 'required_unless:type_demande,Entreprise|file|mimes:pdf|max:2048',
            'formation_id' => 'required_if:type_demande,Professeur|exists:formations,id',
            'niveau_etude' => 'required_if:type_demande,Etudiant',
            'annee_diplome' => 'required_if:type_demande,Alumni|integer|min:1900|max:' . date('Y'),
            'nom_entreprise' => 'required_if:type_demande,Entreprise',
            'secteur_activite' => 'required_if:type_demande,Entreprise',
        ]);

        $demande = new DemandeChangementStatut();
        $demande->user_id = Auth::id();
        $demande->type_demande = $request->type_demande;
        $demande->message = $request->message;
        $demande->statut = 'en_attente';

        if ($request->hasFile('cv')) {
            $path = $request->file('cv')->store('cv', 'public');
            $demande->cv = $path;
        }

        switch ($request->type_demande) {
            case 'Etudiant':
                $demande->niveau_etude = $request->niveau_etude;
                break;
            case 'Professeur':
                $demande->formation_id = $request->formation_id;
                break;
            case 'Alumni':
                $demande->annee_diplome = $request->annee_diplome;
                break;
            case 'Entreprise':
                $demande->nom_entreprise = $request->nom_entreprise;
                $demande->secteur_activite = $request->secteur_activite;
                break;
        }

        $demande->save();

        return response()->json(['success' => true]);
    }
}