<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'foto_laporan', 'nama_laporan', 'jenis_laporan', 
        'lokasi_laporan', 'deskripsi_laporan', 
        'tanggal_laporan', 'waktu_laporan'
    ];

    // Beritahu Laravel format tanggal yang digunakan Oracle
    protected $dateFormat = 'Y-m-d H:i:s'; 

    protected $casts = [
        'tanggal_laporan' => 'datetime',
        'waktu_laporan' => 'datetime',
    ];
}
