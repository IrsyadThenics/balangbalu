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
        try {
            \Illuminate\Support\Facades\DB::unprepared("
                CREATE OR REPLACE VIEW v_report_details AS
                SELECT 
                    r.id AS report_id,
                    r.nama_laporan,
                    r.jenis_laporan,
                    r.lokasi_laporan,
                    r.deskripsi_laporan,
                    r.tanggal_laporan,
                    r.waktu_laporan,
                    r.status,
                    r.user_id AS reporter_id,
                    u.name AS reporter_name,
                    u.email AS reporter_email
                FROM reports r
                LEFT JOIN users u ON r.user_id = u.id
            ");
        } catch (\Exception $e) {
            // If CREATE VIEW fails due to insufficient privileges, log and continue
           // \Log::warning('Could not create view v_report_details: ' . $e->getMessage());
           // \Log::warning('Please ensure your Oracle user has CREATE VIEW privilege');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::unprepared("DROP VIEW IF EXISTS v_report_details");
    }
};
