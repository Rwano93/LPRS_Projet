<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('professeurs', function (Blueprint $table) {
            $table->unsignedBigInteger('ref_user')->primary();
            $table->string('specialite')->nullable();
            $table->timestamps();

            $table->foreign('ref_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('professeurs');
    }
};

