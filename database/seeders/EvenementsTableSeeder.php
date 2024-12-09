<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evenement;

class EvenementsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 15; $i++) {
            Evenement::create([
                'type' => $faker->randomElement(['Conférence', 'Atelier', 'Séminaire', 'Networking']),
                'titre' => $faker->sentence,
                'description' => $faker->paragraphs(3, true),
                'date' => $faker->dateTimeBetween('now', '+6 months'),
                'adresse' => $faker->address,
                'elementrequis' => $faker->optional()->sentence,
                'nb_place' => $faker->numberBetween(10, 200),
            ]);
        }
    }
}