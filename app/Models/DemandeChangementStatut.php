<?php

namespace App\Models;

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