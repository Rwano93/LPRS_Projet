<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'company_id',
        'status',
    ];

    /**
     * Get the company that owns the job offer.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the applicants for the job offer.
     */
    public function applicants()
    {
        return $this->belongsToMany(User::class, 'job_applications'); // Assurez-vous de créer la table pivot 'job_applications'
    }
}
