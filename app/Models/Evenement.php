<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    // Définit les champs qui peuvent être assignés en masse
    protected $fillable = [
        'type',
        'titre',
        'description',
        'adresse',
        'elementrequis',
        'nb_place',
        'date',
    ];

    // Définit la relation avec le modèle Inscription
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'ref_evenement');
    }

    // Définit la relation avec le modèle Organisation
    public function organisations()
    {
        return $this->hasMany(Organisation::class, 'ref_evenement');
    }

    public function isUserCreator($userId)
    {
        return $this->user_id === $userId;
    }

    public function isUserInscrit($userId)
    {
        return $this->inscriptions()->where('user_id', $userId)->exists();
    }

    // Définit la relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_user');
    }

    // Nouvelle relation avec le modèle EvenementAvant
    public function evenementAvants()
    {
        return $this->hasMany(EvenementPasser::class, 'ref_evenement');
    }
}