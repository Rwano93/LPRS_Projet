<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'ref_role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'ref_role');
    }
    public function demandesChangementStatut()
    {
        return $this->hasMany(DemandeChangementStatut::class);
    }

    public function hasRole($roles)
    {
        $roles = is_array($roles) ? $roles : explode('|', $roles);

        return in_array($this->ref_role, $roles);
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
}
