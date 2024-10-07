<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheEntreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'rue',
        'code_postal',
        'ville',
    ];
}
