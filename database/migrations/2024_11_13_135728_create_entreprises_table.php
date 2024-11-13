<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('adresse');
            $table->string('site_web')->unique();
            $table->timestamps();
        });

        Schema::create('entreprise_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('poste');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entreprise_user');
        Schema::dropIfExists('entreprises');
    }
};