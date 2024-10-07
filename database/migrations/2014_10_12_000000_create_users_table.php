<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 191);
            $table->string('email', 191)->unique();
            $table->integer('age')->unsigned();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            $table->text('two_factor_secret')->nullable(); 
            $table->text('two_factor_recovery_codes')->nullable(); 
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->foreignId('current_team_id')->nullable()->constrained('teams'); 
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
