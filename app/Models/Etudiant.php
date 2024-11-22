<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $table = 'etudiants';
    protected $primaryKey = 'ref_user';
    public $incrementing = false;

    protected $fillable = [
        'ref_user',
        'cv',
        'etude'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_user');
    }
}