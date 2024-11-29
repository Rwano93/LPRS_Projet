<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualiteAvant extends Model
{
    use HasFactory;

    protected $table = 'actualiteeavant';

    protected $primaryKey = 'ref_actualites';

    public $incrementing = false;

    protected $fillable = [
        'ref_actualites',
    ];

    public function actualite()
    {
        return $this->belongsTo(Actualite::class, 'ref_actualites');
    }
}