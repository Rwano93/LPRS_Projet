<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Jeux',
            'Nourriture',
            'Matières scolaires',
            'Sports',
            'Musique',
            'Cinéma',
            'Littérature',
            'Technologie',
            'Art',
            'Voyage',
            'Mode',
            'Santé',
            'Nature',
            'Histoire',
            'Science'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}