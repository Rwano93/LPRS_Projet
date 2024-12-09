<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreAvant extends Model
{
    use HasFactory;

    protected $table = 'offreavant';

    protected $fillable = [
        'ref_offre',
    ];

    public function offre()
    {
        return $this->belongsTo(Offre::class, 'ref_offre');
    }
}

