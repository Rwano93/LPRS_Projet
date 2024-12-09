<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->boolean('is_partner')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users');
        });

        Schema::table('entreprise_user', function (Blueprint $table) {
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');
        });
    }

    public function down()
    {
        Schema::table('entreprise_user', function (Blueprint $table) {
            $table->dropColumn(['is_verified', 'verified_at', 'verified_by']);
        });

        Schema::table('entreprises', function (Blueprint $table) {
            $table->dropColumn(['is_partner', 'created_by']);
        });
    }
};
