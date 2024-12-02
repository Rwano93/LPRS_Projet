<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(
            ['id' => 1],
            ['libelle' => 'Nouveau']
        );

        // Créez l'utilisateur de test
        User::factory()->create([
            'nom' => 'Test User',
            'prenom' => 'Test',
            'email' => 'test@example.com',
            'ref_role' => 1, // ID du rôle "Nouveau"
        ]);

    }
}