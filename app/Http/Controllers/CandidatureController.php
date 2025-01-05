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
    public function index(Offre $offre)
    {
        // Vérifier si l'utilisateur est l'auteur de l'offre
        if (Auth::id() !== $offre->user_id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à voir ces candidatures.');
        }

        $candidatures = $offre->candidatures()->with('user')->get();
        return view('candidatures.index', compact('offre', 'candidatures'));
        
        $candidatures = $offre->candidatures()->with('user')->get();
    return view('candidatures.index', compact('offre', 'candidatures'));
    }

    public function accepter(Candidature $candidature)
    {
        // Vérifier si l'utilisateur est l'auteur de l'offre
        if (Auth::id() !== $candidature->offre->user_id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }

        $candidature->statut = 'acceptée';
        $candidature->save();

        // Envoyer un email au candidat
        Mail::to($candidature->user->email)->send(new \App\Mail\CandidatureAcceptee($candidature));

        return redirect()->back()->with('success', 'La candidature a été acceptée.');
    }

    public function refuser(Candidature $candidature)
    {
        // Vérifier si l'utilisateur est l'auteur de l'offre
        if (Auth::id() !== $candidature->offre->user_id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action.');
        }

        $candidature->statut = 'refusée';
        $candidature->save();

        // Envoyer un email au candidat
        Mail::to($candidature->user->email)->send(new \App\Mail\CandidatureRefusee($candidature));

        return redirect()->back()->with('success', 'La candidature a été refusée.');
    }
}