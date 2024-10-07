<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publier extends Model
{
    use HasFactory;

    protected $table = 'publier'; 

    protected $fillable = [
        'id_utilisateur',
        'id_offre',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function offre()
    {
        return $this->belongsTo(Offre::class, 'id_offre');
    }
}
