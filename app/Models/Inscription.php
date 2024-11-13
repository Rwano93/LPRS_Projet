<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $table = 'inscriptions';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['ref_user', 'ref_evenement'];

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_user');
    }

    public function evenement()
    {
        return $this->belongsTo(Evenement::class, 'ref_evenement');
    }
}