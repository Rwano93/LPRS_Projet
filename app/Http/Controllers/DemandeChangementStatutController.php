<?php

namespace App\Http\Controllers;

use App\Models\DemandeChangementStatut;
use App\Models\Formation;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    // Validation des données en fonction du rôle
    $validated = $this->validateDemande($request);

    Log::info('Validation réussie', ['validated_data' => $validated]);

    // Enregistrement du fichier CV si disponible
    $cvPath = null;
    if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
        $cvPath = $request->file('cv')->store('cvs', 'public');
        Log::info('Fichier CV téléchargé', ['cv_path' => $cvPath]);
    } else {
        Log::warning('Pas de fichier CV ou fichier invalide');
    }

    try {
        // Création de la demande avec les données validées
        $demande = DemandeChangementStatut::create([
            'user_id' => Auth::id(),
            'role_id' => $request->role_id,
            'type_demande' => $this->getTypeDemande($request),
            'statut' => 'en_attente',
            'message' => $validated['message'],
            'cv' => $cvPath,
            'filiere' => $request->filiere ?? null,
            'formation_id' => $request->formation_id ?? null,
            'annee_diplome' => $request->annee_diplome ?? null,
            'entreprise' => $request->nom_entreprise ?? null,
            'poste' => $request->poste ?? null,
        ]);

        Log::info('Demande créée', ['demande' => $demande]);

        // Si tout se passe bien, rediriger avec un message de succès
        return redirect()->route('demandes.index')->with('success', 'Votre demande a été soumise avec succès.');
    } catch (\Exception $e) {
        // Gestion des erreurs
        Log::error('Erreur lors de la création de la demande', ['error' => $e->getMessage()]);
        return back()->with('error', 'Une erreur est survenue lors de la soumission de votre demande.')->withInput();
    }
}

    




private function getTypeDemande(Request $request)
{
    // Vous pouvez obtenir le type de la demande en fonction du role_id ou d'autres critères
    $role = Role::findOrFail($request->role_id);
    return strtolower($role->libelle); // Retourne 'etudiant', 'professeur', 'alumni', 'entreprise'
}

private function validateDemande(Request $request)
{
    // Règles de validation pour chaque type de demande
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
   

}