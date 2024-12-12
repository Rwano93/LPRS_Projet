<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('collaborateur_demandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_demande_evenement');
            $table->unsignedBigInteger('ref_collaborateur');
            $table->string('statut')->default('en_attente');
            $table->timestamps();

            $table->foreign('ref_demande_evenement')->references('id')->on('demande_evenements')->onDelete('cascade');
            $table->foreign('ref_collaborateur')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('collaborateur_demandes');
    }
};