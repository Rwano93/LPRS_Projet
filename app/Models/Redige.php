<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redige extends Model
{
    use HasFactory;

    protected $table = 'redige'; 

    protected $fillable = [
        'id_utilisateur',
        'id_post',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }
}
