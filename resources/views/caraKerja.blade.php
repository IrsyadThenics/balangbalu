@extends('layouts.app')

@section('content')
<style>
    /* Styling Spesifik Halaman Cara Kerja agar Sesuai Tema */
    :root {
        --primary-gradient: linear-gradient(135deg, #40434E 0%, #6f727c 100%);
        --text-dark: #0f172a;
        --text-muted: #64748b;
    }

    .how-it-works-section {
        padding: 80px 0 100px;
    }

    .section-title {
        font-weight: 800;
        font-size: clamp(2.5rem, 8vw, 3.5rem);
        letter-spacing: -0.04em;
        margin-bottom: 1.5rem;
    }

    .gradient-text {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    .section-subtitle {
        color: var(--text-muted);
        font-size: 1.125rem;
        max-width: 600px;
        margin: 0 auto 4rem;
    }

    /* Styling Kartu Langkah Modern dengan Glassmorphism */
    .step-card {
        background: rgba(248, 244, 239, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 2.5rem;
        height: 100%;
        border: 1px solid #dfd7ca;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        position: relative;
        overflow: hidden;
    }

    .step-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: #40434E;
    }

    .step-number {
        position: absolute;
        top: -10px;
        right: -10px;
        font-size: 6rem;
        font-weight: 800;
        color: rgba(64, 67, 78, 0.05);
        line-height: 1;
        transition: color 0.3s ease;
    }

    .step-card:hover .step-number {
        color: rgba(64, 67, 78, 0.1);
    }

    .icon-box {
        width: 64px;
        height: 64px;
        background: #efeae4;
        color: #40434E;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        transition: background 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .step-card:hover .icon-box {
        background: var(--primary-gradient);
        color: white;
    }

    .icon-box i {
        width: 32px;
        height: 32px;
    }

    .step-card h3 {
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--text-dark);
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .step-card p {
        color: var(--text-muted);
        line-height: 1.7;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
</style>

<div class="container how-it-works-section">
    <div class="text-center">
        <h1 class="section-title animate-up">
            Cara Kerja <span class="gradient-text">BALANG</span>
        </h1>
        <p class="section-subtitle animate-up delay-1">
            Proses mudah dan transparan untuk melaporkan, mencari, dan menemukan kembali barang Anda yang hilang atau mengembalikan barang temuan.
        </p>
    </div>

    <div class="row g-4 justify-content-center">
        <!-- Langkah 1 -->
        <div class="col-md-6 col-lg-3 animate-up delay-1">
            <div class="step-card">
                <div class="step-number">01</div>
                <div class="icon-box">
                    <i data-lucide="log-in"></i>
                </div>
                <h3>Buat Akun</h3>
                <p>Daftar atau masuk ke platform kami untuk mulai melaporkan atau mencari barang. Prosesnya cepat dan gratis.</p>
            </div>
        </div>

        <!-- Langkah 2 -->
        <div class="col-md-6 col-lg-3 animate-up delay-2">
            <div class="step-card">
                <div class="step-number">02</div>
                <div class="icon-box">
                    <i data-lucide="edit-3"></i>
                </div>
                <h3>Buat Laporan</h3>
                <p>Isi detail barang yang hilang atau ditemukan. Unggah foto, beri deskripsi, dan tentukan lokasi terakhir.</p>
            </div>
        </div>

        <!-- Langkah 3 -->
        <div class="col-md-6 col-lg-3 animate-up delay-3">
            <div class="step-card">
                <div class="step-number">03</div>
                <div class="icon-box">
                    <i data-lucide="search"></i>
                </div>
                <h3>Pencarian Otomatis</h3>
                <p>Sistem kami akan mencocokkan laporan barang hilang dengan barang temuan secara otomatis dan real-time.</p>
            </div>
        </div>
        
        <!-- Langkah 4 -->
        <div class="col-md-6 col-lg-3 animate-up delay-4">
            <div class="step-card">
                <div class="step-number">04</div>
                <div class="icon-box">
                    <i data-lucide="check-circle"></i>
                </div>
                <h3>Barang Kembali</h3>
                <p>Setelah cocok, verifikasi kepemilikan dan atur pertemuan untuk mengembalikan barang dengan aman.</p>
            </div>
        </div>
    </div>
</div>
@endsection
