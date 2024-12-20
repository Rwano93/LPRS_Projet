<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offre;
use App\Models\Entreprise;
use App\Models\User;
use App\Models\Formation;
use Illuminate\Support\Facades\DB;

class OffresTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');

        $entreprises = Entreprise::all();
        $users = User::all();
        $formations = Formation::all();

        if ($entreprises->isEmpty() || $users->isEmpty() || $formations->isEmpty()) {
            $this->command->error('Entreprises, Users, or Formations are missing. Please run their respective seeders first.');
            return;
        }

        DB::beginTransaction();

        try {
            for ($i = 0; $i < 15; $i++) {
                $offre = Offre::create([
                    'titre' => $faker->jobTitle,
                    'description' => $faker->paragraphs(3, true),
                    'missions' => $faker->paragraphs(2, true),
                    'salaire' => $faker->optional()->numberBetween(1500, 5000),
                    'type' => $faker->randomElement(['stage', 'alternance', 'CDD', 'CDI']),
                    'est_ouverte' => $faker->boolean(80),
                    'entreprise_id' => $entreprises->random()->id,
                    'user_id' => $users->random()->id,
                ]);

                // Attach random formations to the offre
                $offre->formations()->attach(
                    $formations->random(rand(1, 3))->pluck('id')->toArray()
                );
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('An error occurred while seeding offres: ' . $e->getMessage());
        }
    }
}

