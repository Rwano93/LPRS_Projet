<?php

namespace App\Http\Controllers;

use App\Models\DemandeChangementStatut;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        try {
            if ($demande->statut !== 'en_attente') {
                return redirect()->route('gestionnaire.demandes.index')
                    ->with('error', 'Cette demande a déjà été traitée.');
            }

            $demande->statut = 'approuve';
            $demande->save();

            $user = $demande->user;
            $user->ref_role = $demande->role_id;
            $user->save();

            Log::info('Demande approuvée et rôle utilisateur mis à jour', [
                'demande_id' => $demande->id,
                'user_id' => $user->id,
                'nouveau_role_id' => $user->ref_role
            ]);

            return redirect()->route('gestionnaire.demandes.index')
                ->with('success', 'Demande approuvée avec succès et rôle de l\'utilisateur mis à jour.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'approbation de la demande', [
                'demande_id' => $demande->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('gestionnaire.demandes.index')
                ->with('error', 'Une erreur est survenue lors de l\'approbation de la demande.');
        }
    }

    public function rejeterDemande(DemandeChangementStatut $demande)
    {
        try {
            if ($demande->statut !== 'en_attente') {
                return redirect()->route('gestionnaire.demandes.index')
                    ->with('error', 'Cette demande a déjà été traitée.');
            }

            $demande->statut = 'rejete';
            $demande->save();

            Log::info('Demande rejetée', [
                'demande_id' => $demande->id,
                'user_id' => $demande->user_id
            ]);

            return redirect()->route('gestionnaire.demandes.index')
                ->with('success', 'Demande rejetée avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors du rejet de la demande', [
                'demande_id' => $demande->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('gestionnaire.demandes.index')
                ->with('error', 'Une erreur est survenue lors du rejet de la demande.');
        }
    }
}