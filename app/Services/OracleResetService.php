<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class OracleResetService
{
    /**
     * Drop all tables and sequences safely for Oracle
     */
    public static function dropAllTables(): void
    {
        $connection = DB::connection('oracle');
        
        try {
            // First, drop all tables
            $tables = $connection->select("SELECT table_name FROM user_tables ORDER BY table_name");
            
            foreach ($tables as $table) {
                try {
                    $connection->statement("DROP TABLE \"{$table->table_name}\" CASCADE CONSTRAINTS");
                } catch (\Exception $e) {
                    \Log::warning("Could not drop table {$table->table_name}: " . $e->getMessage());
                }
            }
            
            // Then, drop user-defined sequences only (exclude system-generated ones)
            // user_sequences already filters to current user's sequences
            $sequences = $connection->select("
                SELECT sequence_name 
                FROM user_sequences 
                WHERE sequence_name NOT LIKE 'BIN\$%' 
                AND sequence_name NOT LIKE 'ISEQ\$\$%'
                AND sequence_name NOT LIKE 'SYSTEM_GENERATED_%'
            ");
            
            foreach ($sequences as $sequence) {
                try {
                    $connection->statement("DROP SEQUENCE \"{$sequence->sequence_name}\"");
                } catch (\Exception $e) {
                    \Log::warning("Could not drop sequence {$sequence->sequence_name}: " . $e->getMessage());
                    // Continue - system-generated sequences will be skipped
                }
            }
        } catch (\Exception $e) {
            \Log::error("Error during Oracle table reset: " . $e->getMessage());
            throw $e;
        }
    }
}

