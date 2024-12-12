<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('demande_evenements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_etudiant');
            $table->unsignedBigInteger('ref_professeur');
            $table->json('donnees_evenement');
            $table->string('statut')->default('en_attente');
            $table->timestamps();
        
            $table->foreign('ref_etudiant')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ref_professeur')->references('id')->on('users')->onDelete('cascade');
        
        });
    }
    public function down()
    {
        Schema::dropIfExists('demandes_evenements');
    }
};

