<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('formation_professeur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professeur_id');
            $table->foreignId('formation_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->foreign('professeur_id')->references('ref_user')->on('professeurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('formation_professeur');
    }
};