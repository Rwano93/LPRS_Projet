<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('prenom')->after('name');
            $table->boolean('est_valide')->default(false)->after('role_id');
            $table->string('promotion')->nullable()->after('est_valide');
            $table->string('cv_path')->nullable()->after('promotion');
            $table->string('poste')->nullable()->after('cv_path');
            $table->string('specialite')->nullable()->after('poste');
            $table->text('motif_inscription')->nullable()->after('specialite');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'prenom',
                'est_valide',
                'promotion',
                'cv_path',
                'poste',
                'specialite',
                'motif_inscription'
            ]);
        });
    }
};