<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evenementpasser', function (Blueprint $table) {
            $table->unsignedBigInteger('ref_evenement');
            $table->foreign('ref_evenement')->references('id')->on('evenements')->onDelete('cascade');
            $table->primary('ref_evenement');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evenementpasser');
    }
};