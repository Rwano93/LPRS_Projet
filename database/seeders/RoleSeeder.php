<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'User', 'description' => 'Regular user']);
        Role::create(['name' => 'Student', 'description' => 'Student user']);
        Role::create(['name' => 'Moderator', 'description' => 'Moderator user']);
        Role::create(['name' => 'Admin', 'description' => 'Administrator']);
        Role::create(['name' => 'Alumni', 'description' => 'Alumni user']);
        Role::create(['name' => 'Teacher', 'description' => 'Teacher user']);
        Role::create(['name' => 'Company', 'description' => 'Company user']);
    }
}