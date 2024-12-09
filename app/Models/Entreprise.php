<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Alumni;
use App\Models\User;
use App\Models\Offre;

class Entreprise extends Model
{
    protected $fillable = [
        'nom',
        'adresse',
        'code_postal',
        'ville',
        'telephone',
        'site_web',
        'created_by'
    ];

    protected $casts = [
        'is_partner' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'entreprise_user')
                    ->withPivot('poste', 'is_verified', 'verified_at', 'verified_by')
                    ->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function alumnis()
    {
        return $this->belongsToMany(Alumni::class, 'entreprise_user', 'entreprise_id', 'user_id')
            ->withPivot('poste')
            ->withTimestamps();
    }


    public function offres()
    {
        return $this->hasMany(Offre::class);
    }
}