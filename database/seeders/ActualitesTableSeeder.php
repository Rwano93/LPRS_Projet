<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actualite;
use App\Models\User;

class ActualitesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');

        $users = User::all();

        for ($i = 0; $i < 15; $i++) {
            Actualite::create([
                'titre' => $faker->sentence,
                'contenu' => $faker->paragraphs(4, true),
                'date_publication' => $faker->dateTimeBetween('-1 year', 'now'),
                'image_url' => $faker->optional()->imageUrl(),
                'user_id' => $users->random()->id,
            ]);
        }
    }
}