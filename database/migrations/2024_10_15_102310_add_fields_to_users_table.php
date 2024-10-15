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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'cv')) {
                $table->string('cv')->nullable();
            }
            if (!Schema::hasColumn('users', 'promo')) {
                $table->string('promo')->nullable();
            }
            if (!Schema::hasColumn('users', 'poste')) {
                $table->string('poste')->nullable();
            }
            if (!Schema::hasColumn('users', 'specialite')) {
                $table->string('specialite')->nullable();
            }
            if (!Schema::hasColumn('users', 'entreprise')) {
                $table->string('entreprise')->nullable();
            }
            if (!Schema::hasColumn('users', 'is_validated')) {
                $table->boolean('is_validated')->default(false);
            }
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
