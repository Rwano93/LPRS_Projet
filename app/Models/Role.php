<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    
    protected $table = 'roles';

    // Champs qui peuvent être remplis
    protected $fillable = ['name'];

    /**
     * Relation avec les utilisateurs.
     * Un rôle peut appartenir à plusieurs utilisateurs.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}
