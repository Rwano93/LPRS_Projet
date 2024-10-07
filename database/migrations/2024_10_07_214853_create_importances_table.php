<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportancesTable extends Migration
{
    public function up()
    {
        Schema::create('importances', function (Blueprint $table) {
            $table->id();
            $table->string('level', 191)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('importances');
    }
}
