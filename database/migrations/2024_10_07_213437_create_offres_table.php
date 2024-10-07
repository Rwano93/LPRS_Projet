<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('CV', 191)->nullable();
            $table->text('description');
            $table->enum('type', ['stage', 'CDD', 'CDI']);
            $table->enum('etat', ['ouverte', 'clôturée']);
            $table->foreignId('id_entreprise')->nullable()->constrained('fiche_entreprises', 'id')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('offres');
    }
}
