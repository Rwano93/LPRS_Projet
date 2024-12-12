<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\EvenementAvant;
use App\Models\DemandeEvenement;
use App\Models\CollaborateurDemande;

class EvenementController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $evenements = Evenement::where('date', '>', Carbon::now()->subDay())->get();

        foreach ($evenements as $evenement) {
            $evenement->isCreator = $evenement->isUserCreator($userId);
        }
        

        return view('evenements.index', compact('evenements'));
    }

    public function getPendingEventRequestsCount()
    {
        return DemandeEvenement::where('statut', 'en_attente')->count();
    }

    public function create()
    {
        $professeurs = User::where('ref_role', User::ROLE_PROFESSOR)->get();
        $collaborateurs = User::where('id', '!=', Auth::id())->get();
        
        return view('evenements.create', compact('professeurs', 'collaborateurs'));
    }

    public function show(Evenement $evenement)
    {
        return view('evenements.show', compact('evenement'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after:now',
            'adresse' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'elementrequis' => 'nullable|string',
            'nb_place' => 'required|integer|min:1',
            'ref_professeur' => Auth::user()->ref_role == User::ROLE_STUDENT ? 'required|exists:users,id,ref_role,' . User::ROLE_PROFESSOR : 'nullable|exists:users,id,ref_role,' . User::ROLE_PROFESSOR,
            'collaborateurs' => 'nullable|array',
            'collaborateurs.*' => 'exists:users,id'
        ]);

        DB::beginTransaction();

        try {
            if (Auth::user()->ref_role == User::ROLE_STUDENT) {
                $eventRequest = DemandeEvenement::create([
                    'ref_etudiant' => Auth::id(),
                    'ref_professeur' => $validatedData['ref_professeur'],
                    'donnees_evenement' => json_encode($validatedData),
                    'statut' => 'en_attente',
                ]);

                if (!empty($validatedData['collaborateurs'])) {
                    foreach ($validatedData['collaborateurs'] as $collaborateurId) {
                        CollaborateurDemande::create([
                            'ref_demande_evenement' => $eventRequest->id,
                            'ref_collaborateur' => $collaborateurId,
                            'statut' => 'en_attente',
                        ]);
                    }
                }

                DB::commit();
                return redirect()->route('evenement.index')->with('status', 'Votre demande de création d\'événement a été envoyée pour approbation.');
            } else {
                $evenement = Evenement::create([
                    'ref_createur' => Auth::id(),
                    'type' => $validatedData['type'],
                    'titre' => $validatedData['titre'],
                    'description' => $validatedData['description'],
                    'date' => $validatedData['date'],
                    'adresse' => $validatedData['adresse'],
                    'elementrequis' => $validatedData['elementrequis'],
                    'nb_place' => $validatedData['nb_place'],
                ]);

                Organisation::create([
                    'ref_user' => Auth::id(),
                    'ref_evenement' => $evenement->id,
                ]);

                if (!empty($validatedData['collaborateurs'])) {
                    foreach ($validatedData['collaborateurs'] as $collaborateurId) {
                        Organisation::create([
                            'ref_user' => $collaborateurId,
                            'ref_evenement' => $evenement->id,
                        ]);
                    }
                }

                DB::commit();
                return redirect()->route('evenement.index')->with('status', 'Événement créé avec succès !');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue lors de la création de l\'événement: ' . $e->getMessage())->withInput();
        }
    }

    public function demandes()
    {
        $demandes = DemandeEvenement::with(['etudiant', 'professeur'])
            ->where('statut', 'en_attente')
            ->get();

        return view('approbation.demandes', compact('demandes'));
    }

    public function approuverDemande(DemandeEvenement $demande)
    {
        DB::beginTransaction();
        try {
            $donnees = json_decode($demande->donnees_evenement, true);
            $evenement = Evenement::create([
                'ref_createur' => $demande->ref_etudiant,
                'type' => $donnees['type'],
                'titre' => $donnees['titre'],
                'description' => $donnees['description'],
                'date' => $donnees['date'],
                'adresse' => $donnees['adresse'],
                'elementrequis' => $donnees['elementrequis'] ?? null,
                'nb_place' => $donnees['nb_place'],
            ]);

            $demande->update(['statut' => 'approuvee']);

            DB::commit();
            return redirect()->route('approbation.demandes')->with('status', 'La demande a été approuvée et l\'événement créé.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('approbation.demandes')->with('error', 'Une erreur est survenue lors de l\'approbation de la demande.');
        }
    }

    public function refuserDemande(DemandeEvenement $demande)
    {
        $demande->update(['statut' => 'refusee']);
        return redirect()->route('approbation.demandes')->with('status', 'La demande a été refusée.');
    }
    public function edit(Evenement $evenement)
    {
        return view('evenements.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'date' => 'required|date|after:now',
            'description' => 'required|string',
            'adresse' => 'required|string|max:255',
            'elementrequis' => 'required|string|max:255',
            'nb_place' => 'required|integer|min:0',
        ]);

        $evenement->update($validatedData);

        return redirect()->route('evenement.index')->with('status', 'Événement mis à jour avec succès!');
    }

    public function destroy(Evenement $evenement)
    {
        try {
            DB::beginTransaction();

            Inscription::where('ref_evenement', $evenement->id)->delete();
            Organisation::where('ref_evenement', $evenement->id)->delete();
            EvenementAvant::where('ref_evenement', $evenement->id)->delete();
            $evenement->delete();

            DB::commit();

            return redirect()->route('evenement.index')->with('status', 'Événement et données associées supprimés avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('evenement.index')->with('error', 'Erreur lors de la suppression de l\'événement : ' . $e->getMessage());
        }
    }

    public function inscription(Evenement $evenement)
    {
        return DB::transaction(function () use ($evenement) {
            if ($evenement->isUserInscrit(Auth::id())) {
                return redirect()->route('evenement.index')->with('error', 'Vous êtes déjà inscrit à cet événement.');
            }

            if ($evenement->nb_place <= 0) {
                return redirect()->route('evenement.index')->with('error', 'Désolé, il n\'y a plus de places disponibles pour cet événement.');
            }

            if ($evenement->date < Carbon::now()) {
                return redirect()->route('evenement.index')->with('error', 'Désolé, cet événement est déjà passé.');
            }

            Inscription::create([
                'ref_evenement' => $evenement->id,
                'ref_user' => Auth::id(),
            ]);

            $evenement->decrement('nb_place');

            return redirect()->route('evenement.index')->with('status', 'Vous êtes bien inscrit. Merci !');
        });
    }

    public function desinscription(Evenement $evenement)
    {
        return DB::transaction(function () use ($evenement) {
            $deleted = Inscription::where('ref_evenement', $evenement->id)
                ->where('ref_user', Auth::id())
                ->delete();

            if ($deleted) {
                $evenement->increment('nb_place');
                return redirect()->route('evenement.index')->with('status', 'Vous êtes bien désinscrit. Merci !');
            }

            return redirect()->route('evenement.index')->with('error', 'Vous n\'étiez pas inscrit à cet événement.');
        });
    }

    public function inscrits(Evenement $evenement)
    {
        $inscriptions = $evenement->inscriptions()->with('user')->get();
        return view('evenements.inscrits', compact('evenement', 'inscriptions'));
    }

    public function removeUserFromEvent(Evenement $evenement, User $user)
    {
        if (!$evenement->isUserCreator(Auth::id())) {
            return redirect()->route('evenement.inscrits', $evenement)
                ->with('error', 'Vous n\'avez pas la permission de supprimer des inscriptions pour cet événement.');
        }

        $deleted = Inscription::where('ref_evenement', $evenement->id)
            ->where('ref_user', $user->id)
            ->delete();

        if ($deleted) {
            $evenement->increment('nb_place');
            return redirect()->route('evenement.inscrits', $evenement)
                ->with('status', "{$user->nom} a bien été supprimé de l'événement \"{$evenement->titre}\".");
        } else {
            return redirect()->route('evenement.inscrits', $evenement)
                ->with('error', 'Cet utilisateur n\'est pas inscrit à cet événement.');
        }
    }
}