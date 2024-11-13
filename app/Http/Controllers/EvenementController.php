<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\EvenementPasser;

class EvenementController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    private function checkUserValidated()
{
    $user = Auth::user();
    if (!$user || !$user->isValidated()) {
        return redirect()->route('home')->with('error', 'Votre compte doit être validé pour accéder à cette fonctionnalité.');
    }
}

public function index()
{
    $user = Auth::user();
    $evenements = Evenement::where('date', '>', Carbon::now()->subDay())->get();

    foreach ($evenements as $evenement) {
        $evenement->isCreator = $evenement->isUserCreator($user->id);
        $evenement->isUserInscrit = $evenement->isUserInscrit($user->id);
    }

    return view('evenements.index', compact('evenements'));
}

    public function create()
{
    $check = $this->checkUserValidated();
    if ($check) return $check;

    $user = Auth::user();

    if (!$user->canCreateEvent()) {
        return redirect()->route('evenements.index')
            ->with('error', 'Vous n\'avez pas la permission de créer un événement.');
    }

    return view('evenements.create');
}

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->canCreateEvent()) {
            return redirect()->route('evenements.index')
                ->with('error', 'Vous n\'avez pas la permission de créer un événement.');
        }

        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date|after:now',
            'adresse' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'elementrequis' => 'nullable|string',
            'nb_place' => 'required|integer|min:1',
        ]);

        if ($user->isStudent() && !$request->has('ref_professor')) {
            return redirect()->route('evenements.create')
                ->with('error', 'Un professeur doit être assigné à l\'événement.');
        }

        $evenement = Evenement::create($validatedData);

        Organisation::create([
            'ref_user' => $user->id,
            'ref_evenement' => $evenement->id,
        ]);

        if ($user->isStudent()) {
            Organisation::create([
                'ref_user' => $request->input('ref_professor'),
                'ref_evenement' => $evenement->id,
            ]);
        }

        return redirect()->route('evenements.index')->with('status', 'Événement créé avec succès !');
    }

    public function edit(Evenement $evenement)
    {
        $user = Auth::user();

        if (!$user->canManageEvent($evenement)) {
            return redirect()->route('evenements.index')
                ->with('error', 'Vous n\'avez pas la permission de modifier cet événement.');
        }

        return view('evenements.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        $user = Auth::user();

        if (!$user->canManageEvent($evenement)) {
            return redirect()->route('evenements.index')
                ->with('error', 'Vous n\'avez pas la permission de modifier cet événement.');
        }

        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'date' => 'required|date_format:Y-m-d\TH:i|after:now',
            'description' => 'required|string',
            'adresse' => 'required|string|max:255',
            'elementrequis' => 'required|string|max:255',
            'nb_place' => 'required|integer|min:0',
        ]);

        $evenement->update($validatedData);

        return redirect()->route('evenements.index')->with('status', 'Événement mis à jour avec succès!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $evenement = Evenement::findOrFail($id);

        if (!$user->canManageEvent($evenement)) {
            return redirect()->route('evenements.index')
                ->with('error', 'Vous n\'avez pas la permission de supprimer cet événement.');
        }

        try {
            DB::beginTransaction();

            Inscription::where('ref_evenement', $id)->delete();
            Organisation::where('ref_evenement', $id)->delete();
            EvenementPasser::where('ref_evenement', $id)->delete();
            $evenement->delete();

            DB::commit();

            return redirect()->route('evenements.index')->with('status', 'Événement et données associées supprimés avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('evenements.index')->with('error', 'Erreur lors de la suppression de l\'événement : ' . $e->getMessage());
        }
    }

    public function inscription(Request $request, Evenement $evenement)
    {
        $user = Auth::user();

        if (!$user->canApplyToOffer()) {
            return redirect()->route('evenements.index')
                ->with('error', 'Vous n\'avez pas la permission de vous inscrire à cet événement.');
        }

        return DB::transaction(function () use ($evenement, $user) {
            $inscriptionExistante = Inscription::where('ref_evenement', $evenement->id)
                ->where('ref_user', $user->id)
                ->first();

            if ($inscriptionExistante) {
                return redirect()->route('evenements.index')->with('error', 'Vous êtes déjà inscrit à cet événement.');
            }

            if ($evenement->nb_place <= 0) {
                return redirect()->route('evenements.index')->with('error', 'Désolé, il n\'y a plus de places disponibles pour cet événement.');
            }

            if ($evenement->date < Carbon::now()) {
                return redirect()->route('evenements.index')->with('error', 'Désolé, cet événement est déjà passé.');
            }

            Inscription::create([
                'ref_evenement' => $evenement->id,
                'ref_user' => $user->id,
            ]);

            $evenement->decrement('nb_place');

            return redirect()->route('evenements.index')->with('status', 'Vous êtes bien inscrit. Merci !');
        });
    }

    public function desinscription(Request $request, Evenement $evenement)
    {
        $user = Auth::user();

        return DB::transaction(function () use ($evenement, $user) {
            $deleted = Inscription::where('ref_evenement', $evenement->id)
                ->where('ref_user', $user->id)
                ->delete();

            if ($deleted) {
                $evenement->increment('nb_place');
                return redirect()->route('evenements.index')->with('status', 'Vous êtes bien désinscrit. Merci !');
            }

            return redirect()->route('evenements.index')->with('error', 'Vous n\'étiez pas inscrit à cet événement.');
        });
    }

    public function inscrits(Evenement $evenement)
    {
        $user = Auth::user();

        if (!$user->canManageEvent($evenement)) {
            return redirect()->route('evenements.index')
                ->with('error', 'Vous n\'avez pas la permission de voir les inscrits à cet événement.');
        }

        $inscriptions = $evenement->inscriptions()->with('user')->get();
        return view('evenements.inscrits', compact('evenement', 'inscriptions'));
    }

    public function removeUserFromEvent(Evenement $evenement, $userId)
    {
        $user = Auth::user();

        if (!$user->canManageEvent($evenement)) {
            return redirect()->route('evenements.inscrits', $evenement->id)
                ->with('error', 'Vous n\'avez pas la permission de supprimer des inscriptions pour cet événement.');
        }

        $deleted = Inscription::where('ref_evenement', $evenement->id)
            ->where('ref_user', $userId)
            ->delete();

        if ($deleted) {
            $evenement->increment('nb_place');
            $user = User::find($userId);
            $userName = $user ? $user->nom : 'L\'utilisateur';
            return redirect()->route('evenements.inscrits', $evenement->id)
                ->with('status', "{$userName} a bien été supprimé de l'événement \"{$evenement->titre}\".");
        } else {
            return redirect()->route('evenements.inscrits', $evenement->id)
                ->with('error', 'Cet utilisateur n\'est pas inscrit à cet événement.');
        }
    }
}