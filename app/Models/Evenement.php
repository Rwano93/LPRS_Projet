<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'date',
        'lieu',
        'places_disponibles',
        'user_id'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'evenement_user')->withTimestamps();
    }

    public function isUserInscrit($userId = null)
    {
        if ($userId === null) {
            $userId = Auth::id();
        }
        return $this->participants()->where('user_id', $userId)->exists();
    }

    public function getFormattedDateAttribute()
    {
        return $this->date->format('d/m/Y H:i');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($evenement) {
            $evenement->participants()->detach();
        });
    }
}