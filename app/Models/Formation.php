<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'description',
        'duree',
        'niveau',
    ];

    public function demandesChangementStatut()
    {
        return $this->hasMany(DemandeChangementStatut::class);
    }
}