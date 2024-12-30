<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use App\Notifications\NouvelleCandidatureNotification;
use App\Mail\CandidatureRejetee;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CandidatureController extends Controller
{
    use AuthorizesRequests;
    public function index(Offre $offre)
    {
        // On vérifie si l'utilisateur a le droit de voir les candidatures pour cette offre
        $this->authorize('viewCandidatures', $offre);

        // On récupère toutes les candidatures pour cette offre avec les informations de l'utilisateur
        $candidatures = $offre->candidatures()->with('user')->get();

        // On retourne la vue avec la liste des candidatures
        return view('candidatures.index', compact('offre', 'candidatures'));
    }

    public function store(Request $request, Offre $offre)
    {
        // Validation des données du formulaire<
        $request->validate([
            'lettre_motivation' => 'required',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Création d'une nouvelle candidature
        $candidature = new Candidature([
            'lettre_motivation' => $request->lettre_motivation,
            'cv_path' => $request->file('cv')->store('cvs', 'public'),
        ]);

        // Association de la candidature à l'utilisateur connecté et à l'offre
        $candidature->user()->associate(Auth::user());
        $candidature->offre()->associate($offre);
        $candidature->save();

        // Envoi d'une notification à l'auteur de l'offre
        $offre->user->notify(new NouvelleCandidatureNotification($candidature));

        // Redirection avec un message de succès
        return back()->with('success', 'Votre candidature a été soumise avec succès.');
        
    }

    public function destroy(Candidature $candidature)
    {
        // On vérifie si l'utilisateur a le droit de supprimer cette candidature
        $this->authorize('delete', $candidature);

        // Envoi d'un email à l'étudiant pour l'informer que sa candidature n'a pas été retenue
        Mail::to($candidature->user->email)->send(new CandidatureRejetee($candidature));

        // Suppression de la candidature
        $candidature->delete();

        // Redirection avec un message de succès
        return back()->with('success', 'La candidature a été supprimée et l\'étudiant a été notifié.');
    }
}

