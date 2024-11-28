<?php

namespace App\Http\Controllers;

use App\Models\DemandeChangementStatut;
use App\Models\Formation;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeChangementStatutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roles = Role::whereIn('libelle', ['Etudiant', 'Professeur', 'Alumni', 'Entreprise'])->get();
        
        if ($user->role->libelle === 'Gestionnaire') {
            $demandes = DemandeChangementStatut::with(['user', 'role'])->latest()->paginate(10);
            return view('demandes.gestionnaire-index', compact('demandes'));
        } else {
            $demandes = DemandeChangementStatut::where('user_id', $user->id)->latest()->get();
            return view('demandes.index', compact('roles', 'demandes'));
        }
    }

    public function createEtudiant()
    {
        $role = Role::where('libelle', 'Etudiant')->firstOrFail();
        return view('demandes.forms.etudiant', compact('role'));
    }

    public function createProfesseur()
    {
        $role = Role::where('libelle', 'Professeur')->firstOrFail();
        $formations = Formation::all();
        return view('demandes.forms.professeur', compact('role', 'formations'));
    }

    public function createAlumni()
    {
        $role = Role::where('libelle', 'Alumni')->firstOrFail();
        return view('demandes.forms.alumni', compact('role'));
    }

    public function createEntreprise()
    {
        $role = Role::where('libelle', 'Entreprise')->firstOrFail();
        return view('demandes.forms.entreprise', compact('role'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'annee_diplome' => 'required|integer|min:1900|max:' . date('Y'),
            'emploi_actuel' => 'required|string|max:255',
            'cv' => 'required|file|mimes:pdf|max:2048', // Max 2MB
            'message' => 'required|string|max:1000',
        ]);

        // Enregistrement du fichier CV
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        // Enregistrement dans la base de données
        $demande = DemandeChangementStatut::create([
            'user_id' => Auth::id(), // ID de l'utilisateur connecté
            'annee_diplome' => $validated['annee_diplome'],
            'emploi_actuel' => $validated['emploi_actuel'],
            'cv_path' => $cvPath ?? null,
            'message' => $validated['message'],
            'role_id' => $request->role_id, // Optionnel, à inclure si pertinent
        ]);

        // Redirection avec succès
        return redirect()->route('demandes.index')->with('success', 'Votre demande a été soumise avec succès.');
    }

    public function show(DemandeChangementStatut $demande)
    {
        return view('demandes.show', compact('demande'));
    }

    public function approuver(DemandeChangementStatut $demande)
    {
        $demande->statut = 'approuve';
        $demande->save();

        return redirect()->route('gestionnaire.demandes.index')->with('success', 'La demande a été approuvée.');
    }

    public function rejeter(DemandeChangementStatut $demande)
    {
        $demande->statut = 'rejete';
        $demande->save();

        return redirect()->route('gestionnaire.demandes.index')->with('success', 'La demande a été rejetée.');
    }
    public function gestionnaireDashboard()
    {
        $demandes = DemandeChangementStatut::with(['user', 'role'])->latest()->paginate(10);
        return view('gestionnaire.dashboard', compact('demandes'));
    }
    private function validateDemande(Request $request)
    {
        $rules = [
            'role_id' => 'required|exists:roles,id',
            'message' => 'required|string',
        ];

        $role = Role::findOrFail($request->role_id);

        switch ($role->libelle) {
            case 'Etudiant':
                $rules['niveau_etude'] = 'required|string';
                $rules['filiere'] = 'required|string';
                $rules['cv'] = 'required|file|mimes:pdf|max:2048';
                break;
            case 'Professeur':
                $rules['formation_id'] = 'required|exists:formations,id';
                $rules['cv'] = 'required|file|mimes:pdf|max:2048';
                break;
            case 'Alumni':
                $rules['annee_diplome'] = 'required|integer|min:1900|max:' . date('Y');
                $rules['emploi_actuel'] = 'required|string';
                $rules['cv'] = 'required|file|mimes:pdf|max:2048';
                break;
            case 'Entreprise':
                $rules['nom_entreprise'] = 'required|string';
                $rules['adresse'] = 'required|string';
                $rules['code_postal'] = 'required|string';
                $rules['ville'] = 'required|string';
                $rules['secteur_activite'] = 'required|string';
                $rules['site_web'] = 'required|url';
                break;
        }

        return $request->validate($rules);
    }
}