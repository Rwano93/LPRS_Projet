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

        // Insérer les formations par défaut
        DB::table('formations')->insert([
            ['nom' => 'TRPM', 'type' => 'Bac professionnel'],
            ['nom' => 'MSPC', 'type' => 'Bac professionnel'],
            ['nom' => 'CIEL', 'type' => 'Bac professionnel'],
            ['nom' => 'STI2D', 'type' => 'Bac technologique'],
            ['nom' => 'CPRP', 'type' => 'BTS'],
            ['nom' => 'MSPC', 'type' => 'BTS'],
            ['nom' => 'SIO', 'type' => 'BTS'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('formations');
    }
};