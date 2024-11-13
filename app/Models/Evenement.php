<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'titre',
        'description',
        'lieu',
        'elements_requis',
        'nombre_places',
        'est_publie'
    ];

    protected $casts = [
        'est_publie' => 'boolean',
    ];

    public function organisateurs()
    {
        return $this->belongsToMany(User::class, 'evenement_organisateur');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'evenement_participant');
    }

    public function aOrganisateurProfesseur()
    {
        return $this->organisateurs()->whereHas('role', function ($query) {
            $query->where('nom', 'Professeur');
        })->exists();
    }

    public function placesDisponibles()
    {
        return $this->nombre_places - $this->participants()->count();
    }
}