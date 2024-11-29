<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreAvant extends Model
{
    use HasFactory;

    protected $table = 'offreavant'; // Assurez-vous que le nom de la table est correct

    protected $fillable = ['ref_offre'];

    public function offre()
    {
        return $this->belongsTo(Offre::class, 'ref_offre'); // Relation avec la table offres
    }
}

