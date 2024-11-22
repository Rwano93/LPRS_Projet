<?php

namespace App\Http\Controllers;

use App\Models\DemandeChangementStatut;
use App\Models\User;
use Illuminate\Http\Request;

class GestionnaireController extends Controller
{
    public function dashboard()
    {
        $demandesEnAttente = DemandeChangementStatut::where('statut', 'en_attente')->count();
        $demandesApprouvees = DemandeChangementStatut::where('statut', 'approuve')->count();
        $demandesRejetees = DemandeChangementStatut::where('statut', 'rejete')->count();
        $totalDemandes = DemandeChangementStatut::count();
        $tauxApprobation = $totalDemandes > 0 ? ($demandesApprouvees / $totalDemandes) * 100 : 0;

        $totalUtilisateurs = User::count();
        $nouveauxUtilisateurs = User::where('created_at', '>=', now()->subWeek())->count();

        return view('gestionnaire.dashboard', compact(
            'demandesEnAttente',
            'demandesApprouvees',
            'demandesRejetees',
            'tauxApprobation',
            'totalUtilisateurs',
            'nouveauxUtilisateurs'
        ));
    }

    public function gererDemandes()
    {
        $demandes = DemandeChangementStatut::with('user', 'role', 'formation')->get();
        return view('gestionnaire.demandes.index', compact('demandes'));
    }

    public function voirDemande(DemandeChangementStatut $demande)
    {
        return view('gestionnaire.demandes.show', compact('demande'));
    }

    public function approuverDemande(DemandeChangementStatut $demande)
    {
        $demande->statut = 'approuve';
        $demande->save();

        $demande->user->roles()->syncWithoutDetaching([$demande->role_id]);

        return redirect()->route('gestionnaire.demandes.index')->with('success', 'Demande approuvée avec succès.');
    }

    public function rejeterDemande(DemandeChangementStatut $demande)
    {
        $demande->statut = 'rejete';
        $demande->save();

        return redirect()->route('gestionnaire.demandes.index')->with('success', 'Demande rejetée avec succès.');
    }
}