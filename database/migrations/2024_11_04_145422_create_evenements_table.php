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
            $table->string('adresse');
            $table->text('elements_requis');
            $table->integer('nb_place');
            $table->datetime('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evenements');
    }
};