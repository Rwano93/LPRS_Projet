<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'missions',
        'salaire',
        'type',
        'est_ouverte',
        'entreprise_id',
        'user_id',
    ];

    protected $casts = [
        'est_ouverte' => 'boolean',
        'salaire' => 'decimal:2',
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_offre');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    public function offreAvant()
    {
        return $this->hasOne(OffreAvant::class, 'ref_offre');
    }
}

