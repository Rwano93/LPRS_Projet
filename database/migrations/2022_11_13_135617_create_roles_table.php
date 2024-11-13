<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Insérer les rôles par défaut
        DB::table('roles')->insert([
            ['nom' => 'Etudiant', 'description' => 'Étudiant actuel de l\'école'],
            ['nom' => 'Alumni', 'description' => 'Ancien élève de l\'école'],
            ['nom' => 'Professeur', 'description' => 'Professeur de l\'école'],
            ['nom' => 'Partenaire', 'description' => 'Partenaire entreprise'],
            ['nom' => 'Gestionnaire', 'description' => 'Gestionnaire de la plateforme'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};