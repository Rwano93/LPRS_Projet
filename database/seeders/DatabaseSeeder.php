<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            EntrepriseSeeder::class,
            FormationSeeder::class,
            OffresTableSeeder::class,
            EvenementsTableSeeder::class,
            ActualitesTableSeeder::class,
        ]);
    

        Role::firstOrCreate(
            ['id' => 1],
            ['libelle' => 'Nouveau']
        );

    }
    
}