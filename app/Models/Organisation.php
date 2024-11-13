<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $table = 'organisations';


    protected $fillable = [
        'ref_user',
        'ref_evenement',
    ];
}
