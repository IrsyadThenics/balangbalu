<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Report;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Report::factory()->create([
            'nama_laporan' => 'Laporan Kerusakan Jalan',
            'jenis_laporan' => 'kehilangan',
            'lokasi_laporan' => 'Jakarta Pusat',
            'deskripsi_laporan' => 'Terdapat lubang besar di tengah jalan utama.',
            'tanggal_laporan' => now(),
            'waktu_laporan' => now(),
            'foto_laporan' => 'default.jpg',
        ]);
         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'role' => 'user',
             'password' => Hash::make('password'),
         ]);
         \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
    }
    
}
