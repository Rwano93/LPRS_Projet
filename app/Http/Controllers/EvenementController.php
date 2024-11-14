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

    public function create()
    {
        return view('evenements.create');
    }
    public function show(Evenement $evenement)
{
    return view('evenements.show', compact('evenement'));
}
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date|after:now',
            'adresse' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'elementrequis' => 'nullable|string',
            'nb_place' => 'required|integer|min:1',
        ]);

        $evenement = Evenement::create($validatedData);

        Organisation::create([
            'ref_user' => Auth::id(),
            'ref_evenement' => $evenement->id,
        ]);

        return redirect()->route('evenement.index')->with('status', 'Événement créé avec succès !');
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