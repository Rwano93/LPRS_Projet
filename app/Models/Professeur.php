<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    protected $table = 'professeurs';
    protected $primaryKey = 'ref_user';
    public $incrementing = false;

    protected $fillable = [
        'ref_user',
        'specialite'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_user');
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_professeur', 'professeur_id', 'formation_id')
            ->withTimestamps();
    }
}