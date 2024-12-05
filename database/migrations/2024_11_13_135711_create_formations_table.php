<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('type');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    
    }

    public function down()
    {
        Schema::dropIfExists('formations');
    }
};