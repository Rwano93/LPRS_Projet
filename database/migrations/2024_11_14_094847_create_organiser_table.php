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
        Schema::create('organisations', function (Blueprint $table) {
            $table->unsignedBigInteger('ref_user');
            $table->unsignedBigInteger('ref_evenement');

            $table->foreign('ref_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ref_evenement')->references('id')->on('evenements')->onDelete('cascade');
            $table->timestamps();

            $table->primary(['ref_user', 'ref_evenement']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisations');
    }
};