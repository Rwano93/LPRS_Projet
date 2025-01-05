<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('candidatures', function (Blueprint $table) {
        $table->enum('statut', ['en_attente', 'acceptée', 'refusée'])->default('en_attente');
    });
}

public function down()
{
    Schema::table('candidatures', function (Blueprint $table) {
        $table->dropColumn('statut');
    });
}
};
