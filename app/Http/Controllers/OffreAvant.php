<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreAvant extends Model
{
    use HasFactory;

    
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
}
