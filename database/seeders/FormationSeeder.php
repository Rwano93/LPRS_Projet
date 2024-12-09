<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormationSeeder extends Seeder
{
    public function run()
    {
        try {
            DB::table('formations')->insert([
                ['nom' => 'TRPM', 'type' => 'Bac professionnel'],
                ['nom' => 'MSPC', 'type' => 'Bac professionnel'],
                ['nom' => 'CIEL', 'type' => 'Bac professionnel'],
                ['nom' => 'STI2D', 'type' => 'Bac technologique'],
                ['nom' => 'CPRP', 'type' => 'BTS'],
                ['nom' => 'MSPC', 'type' => 'BTS'],
                ['nom' => 'SIO', 'type' => 'BTS'],
            ]);

            $this->command->info('Les formations ont été insérées avec succès.');
        } catch (\Exception $e) {
            $this->command->error('Une erreur est survenue lors de l\'insertion des formations : ' . $e->getMessage());
        }
    }
}

