<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entreprise;
use Faker\Factory as Faker;

class EntrepriseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            Entreprise::create([
                'nom' => $faker->company,
                'adresse' => $faker->streetAddress,
                'code_postal' => $faker->postcode,
                'ville' => $faker->city,
                'telephone' => $faker->numerify('##########'), // Generates a 10-digit number
                'site_web' => $faker->url,
            ]);
        }

        $this->command->info('3 entreprises ont été créées avec succès.');
    }
}

