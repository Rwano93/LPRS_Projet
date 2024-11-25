<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeChangementStatut extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
        'message',
        'cv',
        'niveau_etude',
        'filiere',
        'formation_id',
        'annee_diplome',
        'emploi_actuel',
        'nom_entreprise',
        'adresse',
        'code_postal',
        'ville',
        'secteur_activite',
        'site_web',
        'statut',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
