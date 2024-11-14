<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['libelle' => 'Nouveau'],
            ['libelle' => 'Etudiant'],
            ['libelle' => 'Alumni'],
            ['libelle' => 'Professeur'],
            ['libelle' => 'Entreprise'],
            ['libelle' => 'Gestionnaire'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}