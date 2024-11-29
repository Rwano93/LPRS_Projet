<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeChangementStatut extends Model
{
    protected $fillable = [
        'user_id',
        'role_id',
        'type_demande',
        'statut',
        'message',
        'cv',
        'filiere',
        'formation_id',
        'annee_diplome',
        'entreprise',
        'poste',
    ];

    // Vous pouvez aussi ajouter des relations comme :
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
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

