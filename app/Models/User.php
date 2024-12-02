<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'ref_role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'ref_role');
    }

    public function demandesChangementStatut()
    {
        return $this->hasMany(DemandeChangementStatut::class);
    }

    public function etudiant()
    {
        return $this->hasOne(Etudiant::class, 'ref_user');
    }

    public function alumni()
    {
        return $this->hasOne(Alumni::class, 'ref_user');
    }

    public function professeur()
    {
        return $this->hasOne(Professeur::class, 'ref_user');
    }

    public function entreprises()
    {
        return $this->belongsToMany(Entreprise::class, 'entreprise_user')
            ->withPivot('poste')
            ->withTimestamps();
    }

    public function getProfileAttribute()
    {
        switch ($this->role->libelle) {
            case 'Etudiant':
                return $this->etudiant;
            case 'Professeur':
                return $this->professeur;
            case 'Alumni':
                return $this->alumni;
            case 'Entreprise':
                return $this->entreprises->first();
            default:
                return null;
        }
    }
}