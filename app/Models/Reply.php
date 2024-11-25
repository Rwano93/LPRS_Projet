<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Importation pour la relation

class Reply extends Model
{
    protected $fillable = ['content', 'discussion_id', 'user_id','image'];

    /**
     * Relation avec la discussion.
     * Une réponse appartient à une discussion.
     *
     * @return BelongsTo
     */
    public function discussion(): BelongsTo
    {
        return $this->belongsTo(Discussion::class);
    }

    /**
     * Relation avec l'utilisateur.
     * Une réponse appartient à un utilisateur.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
