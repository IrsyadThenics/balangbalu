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
        //untuk database oracle
        Schema::create('reports', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->nullable();  // TAMBAHKAN BARIS INI
        $table->string('foto_laporan', 255)->nullable();
        $table->string('nama_laporan', 255)->nullable();
        $table->string('jenis_laporan', 255)->nullable();   //jadikan ini sebagai dropdown
        $table->string('lokasi_laporan', 255)->nullable();
        $table->string('deskripsi_laporan', 255)->nullable();
        $table->date('tanggal_laporan')->nullable();
        $table->dateTime('waktu_laporan')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
