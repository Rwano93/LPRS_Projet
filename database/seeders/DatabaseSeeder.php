<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $this->call([
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