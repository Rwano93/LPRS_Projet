<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['student', 'alumni', 'partner', 'professor', 'admin']);
            $table->string('promotion_year')->nullable();
            $table->text('cv')->nullable();
            $table->string('company_position')->nullable();
            $table->string('subject')->nullable();  
            $table->string('company_name')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
