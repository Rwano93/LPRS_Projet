<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedigeTable extends Migration
{
    public function up()
    {
        Schema::create('redige', function (Blueprint $table) {
            $table->bigInteger('id_utilisateur')->unsigned();
            $table->bigInteger('id_post')->unsigned();
            $table->timestamps();

            $table->primary(['id_utilisateur', 'id_post']);
            $table->foreign('id_utilisateur')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_post')->references('id_post')->on('posts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('redige');
    }
}
