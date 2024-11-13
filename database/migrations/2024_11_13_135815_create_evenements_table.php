<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('titre');
            $table->text('description');
            $table->string('lieu');
            $table->text('elements_requis')->nullable();
            $table->integer('nombre_places');
            $table->boolean('est_publie')->default(false);
            $table->timestamps();
        });

        Schema::create('evenement_organisateur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evenement_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('evenement_participant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evenement_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evenement_participant');
        Schema::dropIfExists('evenement_organisateur');
        Schema::dropIfExists('evenements');
    }
};