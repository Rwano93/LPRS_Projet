<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use App\Notifications\CompanyLinkRequested;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class EntrepriseController extends Controller
{   use AuthorizesRequests;

    public function index()
    {
        $entreprises = Entreprise::with(['users', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('entreprises.index', compact('entreprises'));
    }

    public function create()
    {
        return view('entreprises.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string|size:5',
            'ville' => 'required|string|max:255',
            'telephone' => 'required|string|size:10',
            'site_web' => 'required|url|unique:entreprises',
            'poste' => 'required|string|max:255',
            'motif_inscription' => 'nullable|required_if:user_type,alumni|string|max:1000',
            'is_partner' => 'boolean',
        ]);

        $entreprise = Entreprise::create([
            'nom' => $validated['nom'],
            'adresse' => $validated['adresse'],
            'code_postal' => $validated['code_postal'],
            'ville' => $validated['ville'],
            'telephone' => $validated['telephone'],
            'site_web' => $validated['site_web'],
            'is_partner' => $validated['is_partner'] ?? false,
            'created_by' => Auth::id(),
        ]);

        $pivotData = [
            'poste' => $validated['poste'],
            'is_verified' => true,
            'verified_at' => now(),
            'verified_by' => Auth::id(),
        ];

        if (Auth::user()->role->libelle === 'Alumni') {
            $pivotData['motif_inscription'] = $validated['motif_inscription'];
        }

        Auth::user()->entreprises()->attach($entreprise->id, $pivotData);

        return redirect()->route('entreprises.index')
            ->with('success', 'Entreprise créée avec succès.');
    }

    public function show(Entreprise $entreprise)
    {
        $entreprise->load(['users', 'creator']);
        return view('entreprises.show', compact('entreprise'));
    }

    public function edit(Entreprise $entreprise)
    {
        $this->authorize('update', $entreprise);
        return view('entreprises.edit', compact('entreprise'));
    }

    public function update(Request $request, Entreprise $entreprise)
    {
        $this->authorize('update', $entreprise);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string|size:5',
            'ville' => 'required|string|max:255',
            'telephone' => 'required|string|size:10',
            'site_web' => ['required', 'url', Rule::unique('entreprises')->ignore($entreprise->id)],
            'is_partner' => 'boolean',
        ]);

        $entreprise->update($validated);

        return redirect()->route('entreprises.show', $entreprise)
            ->with('success', 'Entreprise mise à jour avec succès.');
    }

    public function requestLink(Request $request, Entreprise $entreprise)
    {
        $validated = $request->validate([
            'poste' => 'required|string|max:255',
            'motif_inscription' => 'required|string|max:1000',
        ]);

        $pivotData = [
            'poste' => $validated['poste'],
            'motif_inscription' => $validated['motif_inscription'],
            'is_verified' => false,
        ];

        Auth::user()->entreprises()->attach($entreprise->id, $pivotData);

        // Notify managers and creator
        $managers = User::whereHas('role', function ($query) {
            $query->where('libelle', 'Gestionnaire');
        })->get();

        $notifyUsers = $managers->push($entreprise->creator)->unique();

        foreach ($notifyUsers as $user) {
            $user->notify(new CompanyLinkRequested(Auth::user(), $entreprise));
        }

        return redirect()->route('entreprises.index')
            ->with('success', 'Demande de rattachement envoyée.');
    }

    public function verifyLink(Request $request, $pivotId)
    {
        $pivot = \DB::table('entreprise_user')->where('id', $pivotId)->first();
        if (!$pivot) {
            abort(404);
        }

        $entreprise = Entreprise::findOrFail($pivot->entreprise_id);
        $this->authorize('verifyLink', $entreprise);

        \DB::table('entreprise_user')
            ->where('id', $pivotId)
            ->update([
                'is_verified' => true,
                'verified_at' => now(),
                'verified_by' => Auth::id(),
            ]);

        return redirect()->back()->with('success', 'Lien vérifié avec succès.');
    }
}
