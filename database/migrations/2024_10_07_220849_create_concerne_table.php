<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcerneTable extends Migration
{
    public function up()
    {
        Schema::create('concerne', function (Blueprint $table) {
            $table->bigInteger('id_post')->unsigned();
            $table->bigInteger('id_reponse')->unsigned();
            $table->timestamps();

            $table->primary(['id_post', 'id_reponse']);
            $table->foreign('id_post')->references('id_post')->on('posts')->onDelete('cascade');
            $table->foreign('id_reponse')->references('id_reponse')->on('reponses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('concerne');
    }
}
