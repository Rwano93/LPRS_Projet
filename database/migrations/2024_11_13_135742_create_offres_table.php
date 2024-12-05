<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->text('missions');
            $table->decimal('salaire', 10, 2)->nullable();
            $table->enum('type', ['stage', 'alternance', 'CDD', 'CDI']);
            $table->boolean('est_ouverte')->default(true);
            $table->foreignId('entreprise_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->comment('Auteur de l\'offre');
            $table->timestamps();
        });

        Schema::create('formation_offre', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formation_id')->constrained()->onDelete('cascade');
            $table->foreignId('offre_id')->constrained()->onDelete('cascade');
            $table->unique(['formation_id', 'offre_id']);
            $table->timestamps();
        });

        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('motivation');
            $table->boolean('est_visible')->default(true);
            $table->timestamps();
            $table->unique(['offre_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidatures');
        Schema::dropIfExists('formation_offre');
        Schema::dropIfExists('offres');
    }
};

