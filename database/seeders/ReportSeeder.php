<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Report::create([
        'nama_laporan' => 'Laporan Kerusakan Jalan',
        'jenis_laporan' => 'kehilangan',
        'lokasi_laporan' => 'Jakarta Pusat',
        'deskripsi_laporan' => 'Terdapat lubang besar di tengah jalan utama.',
        'tanggal_laporan' => now(),
        'waktu_laporan' => now(),
        'foto_laporan' => 'default.jpg',
    ]);
    \App\Models\Report::create([
        'nama_laporan' => 'Laporan Banjir',
        'jenis_laporan' => 'menemukan',
        'lokasi_laporan' => 'Bandung',
        'deskripsi_laporan' => 'Air mulai masuk ke pemukiman warga.',
        'tanggal_laporan' => now(),
        'waktu_laporan' => now(),
        'foto_laporan' => 'default.jpg',
    ]);
    }
}
