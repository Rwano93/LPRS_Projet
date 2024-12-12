<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_createur',
        'type',
        'titre',
        'description',
        'adresse',
        'elementrequis',
        'nb_place',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'ref_evenement');
    }

    public function isUserInscrit($userId)
    {
        return $this->inscriptions()->where('ref_user', $userId)->exists();
    }

    public function organisations()
    {
        return $this->hasMany(Organisation::class, 'ref_evenement');
    }

    public function isUserCreator($userId)
    {
        return $this->organisations()->where('ref_user', $userId)->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_user');
    }

    public function evenementAvants()
    {
        return $this->hasMany(EvenementAvant::class, 'ref_evenement');
    }
}