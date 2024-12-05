<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementAvant extends Model
{
    use HasFactory;

    protected $table = 'evenementavant';

    protected $primaryKey = 'ref_evenement';

    public $incrementing = false;

    protected $fillable = [
        'ref_evenement',
    ];

    public function evenement()
    {
        return $this->belongsTo(Evenement::class, 'ref_evenement');
    }
}

