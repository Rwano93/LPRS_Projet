<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'titre',
        'description',
        'adresse',
        'elements_requis',
        'nb_place',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}