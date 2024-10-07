<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFicheEntreprisesTable extends Migration
{
    public function up()
    {
        Schema::create('fiche_entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('rue', 255)->nullable();
            $table->string('code_postal', 10)->nullable();
            $table->string('ville', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fiche_entreprises');
    }
}
