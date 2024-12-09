<?php

namespace Database\Factories;

use App\Models\Offre;
use Illuminate\Database\Eloquent\Factories\Factory;

class OffreFactory extends Factory
{
    protected $model = Offre::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'type_contrat' => $this->faker->randomElement(['CDI', 'CDD', 'Stage', 'Alternance']),
            'date_debut' => $this->faker->dateTimeBetween('now', '+6 months'),
            'date_fin' => $this->faker->optional()->dateTimeBetween('+6 months', '+1 year'),
            'salaire' => $this->faker->numberBetween(20000, 100000),
        ];
    }
}