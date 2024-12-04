<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Entreprise extends Model
{
    protected $fillable = [
        'nom',
        'adresse',
        'code_postal',
        'ville',
        'telephone',
        'site_web',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'entreprise_user')
                    ->withPivot('poste', 'motif_inscription')
                    ->withTimestamps();
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