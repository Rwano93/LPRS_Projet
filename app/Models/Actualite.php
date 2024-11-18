<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'contenu',
        'date_publication',
        'image_url',
    ];

    protected $casts = [
        'date_publication' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}