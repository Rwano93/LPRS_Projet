<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_createur');
            $table->string('type');
            $table->string('titre');
            $table->text('description');
            $table->dateTime('date');
            $table->string('adresse');
            $table->text('elementrequis')->nullable();
            $table->integer('nb_place');
            $table->string('statut')->default('actif');
            $table->timestamps();

            $table->foreign('ref_createur')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};