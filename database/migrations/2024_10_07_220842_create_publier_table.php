<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublierTable extends Migration
{
    public function up()
    {
        Schema::create('publier', function (Blueprint $table) {
            $table->bigInteger('id_utilisateur')->unsigned();
            $table->bigInteger('id_offre')->unsigned();
            $table->timestamps();

            $table->primary(['id_utilisateur', 'id_offre']);
            $table->foreign('id_utilisateur')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_offre')->references('id_offre')->on('offres')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('publier');
    }
}
