<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaborateurDemande extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_demande_evenement',
        'ref_collaborateur',
        'statut',
    ];

    public function demandeEvenement()
    {
        return $this->belongsTo(DemandeEvenement::class, 'ref_demande_evenement');
    }

    public function collaborateur()
    {
        return $this->belongsTo(User::class, 'ref_collaborateur');
    }
}