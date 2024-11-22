<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demande_changement_statuts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->enum('type_demande', ['etudiant', 'professeur', 'alumni', 'partenaire']);
            $table->enum('statut', ['en_attente', 'approuve', 'rejete'])->default('en_attente');
            $table->text('message');
            $table->string('cv')->nullable();
            $table->string('filiere')->nullable();
            $table->foreignId('formation_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('annee_diplome')->nullable();
            $table->string('entreprise')->nullable();
            $table->string('poste')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demande_changement_statuts');
    }
};