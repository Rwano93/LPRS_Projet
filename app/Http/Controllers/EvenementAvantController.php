<?php

namespace App\Http\Controllers;

use App\Models\EvenementAvant;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvenementAvantController extends Controller
{
    public function index()
    {
        $evenements = Evenement::where('date', '>=', now())
            ->orderBy('date')
            ->take(4)
            ->get();

        $actualites = EvenementAvant::with(['evenement' => function ($query) {
            $query->where('date', '>=', now());
        }])
        ->whereHas('evenement', function ($query) {
            $query->where('date', '>=', now());
        })
        ->take(4)
        ->get();

        $userId = Auth::id();

        foreach ($evenements as $event) {
            $event->isCreator = $event->isUserCreator($userId);
            $event->isInscrit = $event->isUserInscrit($userId);
        }

        return view('dashboard', compact('evenements', 'actualites'));
    }
}