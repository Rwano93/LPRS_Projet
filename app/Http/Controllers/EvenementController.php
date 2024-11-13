<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class EvenementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $evenements = Evenement::where('est_publie', true)->get();
        return view('evenements.index', compact('evenements'));
    }

    public function create()
    {
        if (Auth::user()->role->nom === 'Gestionnaire') {
            return redirect()->route('evenements.index')->with('error', 'Les gestionnaires ne peuvent pas créer d\'événements.');
        }
        return view('evenements.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lieu' => 'required|string|max:255',
            'elements_requis' => 'nullable|string',
            'nombre_places' => 'required|integer|min:1',
            'organisateurs' => 'required|array',
            'organisateurs.*' => 'exists:users,id'
        ]);

        $evenement = Evenement::create($validatedData);
        $evenement->organisateurs()->attach($validatedData['organisateurs']);

        if ($evenement->aOrganisateurProfesseur()) {
            $evenement->update(['est_publie' => true]);
        }

        return redirect()->route('evenements.show', $evenement)->with('success', 'Événement créé avec succès.');
    }

    public function show(Evenement $evenement)
    {
        return view('evenements.show', compact('evenement'));
    }

    public function edit(Evenement $evenement)
    {
        if (!$evenement->organisateurs->contains(Auth::id())) {
            return redirect()->route('evenements.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cet événement.');
        }
        return view('evenements.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        if (!$evenement->organisateurs->contains(Auth::id())) {
            return redirect()->route('evenements.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cet événement.');
        }

        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lieu' => 'required|string|max:255',
            'elements_requis' => 'nullable|string',
            'nombre_places' => 'required|integer|min:1',
            'organisateurs' => 'required|array',
            'organisateurs.*' => 'exists:users,id'
        ]);

        $evenement->update($validatedData);
        $evenement->organisateurs()->sync($validatedData['organisateurs']);

        if ($evenement->aOrganisateurProfesseur()) {
            $evenement->update(['est_publie' => true]);
        } else {
            $evenement->update(['est_publie' => false]);
        }

        return redirect()->route('evenements.show', $evenement)->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Evenement $evenement)
    {
        if (!$evenement->organisateurs->contains(Auth::id())) {
            return redirect()->route('evenements.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer cet événement.');
        }

        $evenement->delete();
        return redirect()->route('evenements.index')->with('success', 'Événement supprimé avec succès.');
    }

    public function inscrire(Evenement $evenement)
    {
        if (Auth::user()->role->nom === 'Gestionnaire') {
            return redirect()->route('evenements.show', $evenement)->with('error', 'Les gestionnaires ne peuvent pas s\'inscrire aux événements.');
        }

        if ($evenement->placesDisponibles() <= 0) {
            return redirect()->route('evenements.show', $evenement)->with('error', 'Il n\'y a plus de places disponibles pour cet événement.');
        }

        $evenement->participants()->attach(Auth::id());
        return redirect()->route('evenements.show', $evenement)->with('success', 'Vous êtes inscrit à l\'événement.');
    }

    public function desinscrire(Evenement $evenement)
    {
        $evenement->participants()->detach(Auth::id());
        return redirect()->route('evenements.show', $evenement)->with('success', 'Vous êtes désinscrit de l\'événement.');
    }

    public function gererInscriptions(Evenement $evenement)
    {
        if (!$evenement->organisateurs->contains(Auth::id())) {
            return redirect()->route('evenements.index')->with('error', 'Vous n\'êtes pas autorisé à gérer les inscriptions de cet événement.');
        }

        $participants = $evenement->participants;
        return view('evenements.gerer-inscriptions', compact('evenement', 'participants'));
    }

    public function refuserInscription(Evenement $evenement, User $user)
    {
        if (!$evenement->organisateurs->contains(Auth::id())) {
            return redirect()->route('evenements.index')->with('error', 'Vous n\'êtes pas autorisé à gérer les inscriptions de cet événement.');
        }

        $evenement->participants()->detach($user->id);
        return redirect()->route('evenements.gerer-inscriptions', $evenement)->with('success', 'L\'inscription a été refusée.');
    }
}