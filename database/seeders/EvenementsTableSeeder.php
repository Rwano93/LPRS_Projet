<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evenement;
use App\Models\User;
use Faker\Factory as Faker;

class EvenementsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all user IDs
        $userIds = User::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            Evenement::create([
                'ref_createur' => $faker->randomElement($userIds),
                'type' => $faker->randomElement(['Conférence', 'Atelier', 'Séminaire', 'Webinaire']),
                'titre' => $faker->sentence,
                'description' => $faker->paragraphs(3, true),
                'date' => $faker->dateTimeBetween('now', '+1 year'),
                'adresse' => $faker->address,
                'elementrequis' => $faker->sentence,
                'nb_place' => $faker->numberBetween(10, 200),
            ]);
        }
    }
}