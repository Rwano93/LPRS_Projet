<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        'profile_photo_path',
        'cv',
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
        'cv_url',
    ];

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            // Ensure the path is properly encoded
            $path = str_replace('\\', '/', $this->profile_photo_path);
            return Storage::disk($this->profilePhotoDisk())->url($path);
        }

        return $this->defaultProfilePhotoUrl();
    }

    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updateProfilePhoto($photo)
    {
        tap($this->profile_photo_path, function ($previous) use ($photo) {
            // Generate a safe filename
            $filename = Str::random(40) . '.' . $photo->getClientOriginalExtension();
            
            $this->forceFill([
                'profile_photo_path' => $photo->storeAs(
                    'profile-photos',
                    $filename,
                    ['disk' => $this->profilePhotoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->profilePhotoDisk())->delete($previous);
            }
        });
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect([$this->nom, $this->prenom])->filter()->join(' '));
        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

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

    public function entreprises(): BelongsToMany
    {
        return $this->belongsToMany(Entreprise::class, 'entreprise_user')
                    ->withPivot('poste', 'motif_inscription')
                    ->withTimestamps();
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
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

    public function getCvUrlAttribute()
    {
        return $this->cv ? Storage::url($this->cv) : null;
    }
}

