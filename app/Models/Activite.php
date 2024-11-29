<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    // Spécifier la table si nécessaire
    // protected $table = 'activites';

    // Les attributs qui peuvent être mass assignés
    protected $fillable = [
        'titre', 'desc', 'date', 'nb_place', 'ref_user',
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_user');
    }
}
