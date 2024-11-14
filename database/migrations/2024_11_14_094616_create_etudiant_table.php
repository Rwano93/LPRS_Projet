<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->unsignedBigInteger('ref_user')->primary(); // Ensure this matches the data type of 'id' in 'users' table
            $table->text('cv');
            $table->text('etude');
            $table->foreignId('ref_etablissement')->constrained('etablissements');
            $table->timestamps();

            $table->foreign('ref_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};