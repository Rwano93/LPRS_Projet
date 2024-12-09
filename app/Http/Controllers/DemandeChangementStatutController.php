<?php

namespace App\Http\Controllers;

use App\Models\DemandeChangementStatut;
use App\Models\Role;
use App\Models\User;
use App\Models\Formation;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function approuver(DemandeChangementStatut $demande)
    {
        DB::beginTransaction();

        try {
            if ($demande->statut !== 'en_attente') {
                throw new \Exception('Cette demande a déjà été traitée.');
            }

            $user = $demande->user;
            $nouveauRole = Role::findOrFail($demande->role_id);

            Log::info('Début de l\'approbation de la demande', [
                'demande_id' => $demande->id,
                'user_id' => $user->id,
                'nouveau_role' => $nouveauRole->libelle
            ]);

            // Mise à jour du statut de la demande
            $demande->statut = 'approuve';
            $demande->save();

            // Mise à jour du rôle de l'utilisateur
            $user->ref_role = $nouveauRole->id;
            $user->save();

            Log::info('Rôle de l\'utilisateur mis à jour', [
                'user_id' => $user->id,
                'nouveau_role_id' => $user->ref_role
            ]);

            // Mise à jour des informations spécifiques au rôle
            switch ($nouveauRole->libelle) {
                case 'Etudiant':
                    // Logique pour mettre à jour les informations de l'étudiant
                    break;
                case 'Professeur':
                    // Logique pour mettre à jour les informations du professeur
                    break;
                case 'Alumni':
                    // Logique pour mettre à jour les informations de l'alumni
                    break;
                case 'Entreprise':
                    // Logique pour mettre à jour les informations de l'entreprise
                    break;
            }

            DB::commit();

            Log::info('Approbation de la demande terminée avec succès', [
                'demande_id' => $demande->id,
                'user_id' => $user->id
            ]);

            return redirect()->route('gestionnaire.demandes.index')
                             ->with('success', 'La demande a été approuvée et le rôle de l\'utilisateur a été mis à jour.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de l\'approbation de la demande', [
                'demande_id' => $demande->id,
                'error' => $e->getMessage()
            ]);
            return redirect()->route('gestionnaire.demandes.index')
                             ->with('error', 'Une erreur est survenue lors de l\'approbation de la demande : ' . $e->getMessage());
        }
    }

    public function rejeter(DemandeChangementStatut $demande)
    {
        if ($demande->statut !== 'en_attente') {
            return redirect()->route('gestionnaire.demandes.index')->with('error', 'Cette demande a déjà été traitée.');
        }

        $demande->statut = 'rejete';
        $demande->save();

        return redirect()->route('gestionnaire.demandes.index')->with('success', 'La demande a été rejetée.');
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
        $validated = $this->validateDemande($request);

        Log::info('Validation réussie', ['validated_data' => $validated]);

        $cvPath = null;
        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            Log::info('Fichier CV téléchargé', ['cv_path' => $cvPath]);
        } else {
            Log::warning('Pas de fichier CV ou fichier invalide');
        }

        DB::beginTransaction();

        try {
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
                'adresse' => $request->adresse ?? null,
                'code_postal' => $request->code_postal ?? null,
                'ville' => $request->ville ?? null,
                'secteur_activite' => $request->secteur_activite ?? null,
                'site_web' => $request->site_web ?? null,
                'telephone' => $request->telephone ?? null,
            ]);

            // For Entreprise role, create an entry in the entreprises table
            if ($this->getTypeDemande($request) === 'partenaire') {
                $entreprise = Entreprise::create([
                    'nom' => $request->nom_entreprise,
                    'adresse' => $request->adresse,
                    'code_postal' => $request->code_postal,
                    'ville' => $request->ville,
                    'telephone' => $request->telephone,
                    'site_web' => $request->site_web,
                ]);

                // Create the pivot table entry
                $entreprise->users()->attach(Auth::id(), [
                    'poste' => $request->poste,
                    'motif_inscription' => $request->message,
                ]);
            }

            DB::commit();

            Log::info('Demande créée', ['demande' => $demande]);

            return redirect()->route('demandes.index')->with('success', 'Votre demande a été soumise avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création de la demande', ['error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la soumission de votre demande.')->withInput();
        }
    }

    private function getTypeDemande(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        return strtolower($role->libelle) === 'entreprise' ? 'partenaire' : strtolower($role->libelle);
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
                $rules['code_postal'] = 'required|string|size:5';
                $rules['ville'] = 'required|string';
                $rules['secteur_activite'] = 'required|string';
                $rules['site_web'] = 'required|url';
                $rules['telephone'] = 'required|string|size:10';
                $rules['poste'] = 'required|string';
                break;
        }

        return $request->validate($rules);
    }

    public function gestionnaireDashboard()
    {
        $demandes = DemandeChangementStatut::with(['user', 'role'])->latest()->paginate(10);
        return view('gestionnaire.dashboard', compact('demandes'));
    }
}
