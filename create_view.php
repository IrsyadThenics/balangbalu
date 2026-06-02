<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$sql = '
CREATE OR REPLACE VIEW V_REPORT_DETAILS AS
SELECT 
    l.ID AS report_id,
    l.NAMA_BARANG AS nama_laporan,
    l.TYPE AS jenis_laporan,
    l.LOKASI AS lokasi_laporan,
    l.DESKRIPSI AS deskripsi_laporan,
    l.TANGGAL AS tanggal_laporan,
    l.WAKTU AS waktu_laporan,
    l.STATUS AS status,
    l.USER_ID AS reporter_id,
    u.NAMA AS reporter_name,
    u.EMAIL AS reporter_email
FROM LAPORAN l
LEFT JOIN USERS u ON l.USER_ID = u.ID
';

try {
    DB::unprepared($sql);
    echo "View V_REPORT_DETAILS successfully created!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
