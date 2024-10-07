<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concerne extends Model
{
    use HasFactory;

    protected $table = 'concerne'; 
    protected $fillable = [
        'id_post',
        'id_reponse',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    public function reponse()
    {
        return $this->belongsTo(Reponse::class, 'id_reponse');
    }
}
