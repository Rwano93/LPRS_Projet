<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'type', 'description', 'missions', 'salaire', 'est_ouverte', 'entreprise_id', 'user_id'];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_offre');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }
}