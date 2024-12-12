<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeEvenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_etudiant',
        'ref_professeur',
        'donnees_evenement',
        'statut',
        
    ];

    public function etudiant()
    {
        return $this->belongsTo(User::class, 'ref_etudiant');
    }

    public function professeur()
    {
        return $this->belongsTo(User::class, 'ref_professeur');
    }

    public function collaborateurDemandes()
    {
        return $this->hasMany(CollaborateurDemande::class, 'ref_demande_evenement');
    }
}