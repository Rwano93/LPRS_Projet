<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{


public function run()
{
    Role::create(['name' => 'etudiant']);
    Role::create(['name' => 'professeur']);
    Role::create(['name' => 'alumni']);
    Role::create(['name'=> 'admin']);
    Role::create(['name'=> 'company']);
}
}
