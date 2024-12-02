<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NiveauEtude;
use Illuminate\Support\Facades\DB;

class NiveauEtudeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Vider la table avant d'insérer de nouvelles données
        NiveauEtude::truncate();

        // Réactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $niveaux = [
            ['libelle' => 'Lycée - Seconde'],
            ['libelle' => 'Lycée - Première'],
            ['libelle' => 'Lycée - Terminale'],
            ['libelle' => 'Bac'],
            ['libelle' => 'Bac +1'],
            ['libelle' => 'Bac +2 (DUT, BTS, DEUG)'],
            ['libelle' => 'Bac +3 (Licence)'],
            ['libelle' => 'Bac +4 (Master 1)'],
            ['libelle' => 'Bac +5 (Master 2)'],
            ['libelle' => 'Bac +8 (Doctorat)'],
            ['libelle' => 'Classes préparatoires'],
            ['libelle' => 'Grande École - 1ère année'],
            ['libelle' => 'Grande École - 2ème année'],
            ['libelle' => 'Grande École - 3ème année'],
            ['libelle' => 'Formation professionnelle'],
            ['libelle' => 'Autre'],
        ];

        foreach ($niveaux as $niveau) {
            NiveauEtude::create($niveau);
        }
    }
}