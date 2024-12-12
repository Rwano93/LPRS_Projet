<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'Nouveau',
            'Etudiant',
            'Alumni',
            'Professeur',
            'Entreprise',
            
        ];

        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['libelle' => $roleName]);

            User::create([
                'nom' => $roleName,  // Changé de 'name' à 'nom'
                'prenom' => $roleName,
                'email' => strtolower($roleName) . '@example.com',
                'password' => Hash::make('password'),
                'ref_role' => $role->id,
                
            ]);
        }
    }
}

