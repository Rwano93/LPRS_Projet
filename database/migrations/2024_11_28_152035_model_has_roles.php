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
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->bigInteger('role_id')->unsigned();
            $table->morphs('model');
            $table->timestamps();

            $table->primary(['role_id', 'model_id', 'model_type']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};