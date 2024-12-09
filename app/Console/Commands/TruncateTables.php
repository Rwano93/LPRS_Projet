<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateTables extends Command
{
    protected $signature = 'db:truncate {--table=* : The tables to truncate}';
    protected $description = 'Truncate specified tables or all tables if none specified';

    public function handle()
    {
        $tables = $this->option('table');

        if (empty($tables)) {
            $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        }

        $this->truncateTables($tables);

        $this->info('Tables truncated successfully!');
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
                $this->line("Truncated: {$table}");
            } else {
                $this->warn("Table not found: {$table}");
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}