<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToRepliesTable extends Migration
{
    public function up()
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->binary('image')->nullable(); // Champ pour stocker le chemin de l'image
        });
    }

    public function down()
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
