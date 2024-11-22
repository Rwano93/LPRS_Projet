<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumnis';
    protected $primaryKey = 'ref_user';
    public $incrementing = false;

    protected $fillable = [
        'ref_user',
        'promotion',
        'cv'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_user');
    }

    public function entreprise()
    {
        return $this->belongsToMany(Entreprise::class, 'entreprise_user', 'user_id', 'entreprise_id')
            ->withPivot('poste')
            ->withTimestamps();
    }
}