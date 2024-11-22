<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'code_postal',
        'ville',
        'telephone',
    ];

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }
}