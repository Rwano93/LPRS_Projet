<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Fortify;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Vérifie si la colonne 'two_factor_secret' existe avant de l'ajouter
            if (!Schema::hasColumn('users', 'two_factor_secret')) {
                $table->text('two_factor_secret')->nullable()->after('password');
            }

            // Vérifie si la colonne 'two_factor_recovery_codes' existe avant de l'ajouter
            if (!Schema::hasColumn('users', 'two_factor_recovery_codes')) {
                $table->text('two_factor_recovery_codes')
                    ->after('two_factor_secret')
                    ->nullable();
            }

            // Vérifie si la colonne 'two_factor_confirmed_at' existe avant de l'ajouter (si la double authentification est activée)
            if (Fortify::confirmsTwoFactorAuthentication() && !Schema::hasColumn('users', 'two_factor_confirmed_at')) {
                $table->timestamp('two_factor_confirmed_at')
                    ->after('two_factor_recovery_codes')
                    ->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('users', 'two_factor_secret')) {
                $columnsToDrop[] = 'two_factor_secret';
            }

            if (Schema::hasColumn('users', 'two_factor_recovery_codes')) {
                $columnsToDrop[] = 'two_factor_recovery_codes';
            }

            if (Fortify::confirmsTwoFactorAuthentication() && Schema::hasColumn('users', 'two_factor_confirmed_at')) {
                $columnsToDrop[] = 'two_factor_confirmed_at';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
