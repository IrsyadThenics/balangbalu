@extends('layouts.app')

@section('content')
<!-- Link ke Font Inter jika belum ada di layout utama -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<!-- Link ke Lucide Icons untuk ikon yang modern -->
<script src="https://unpkg.com/lucide@latest"></script>

<style>
    /* Styling Spesifik Halaman Fitur agar Sesuai Tema */
    :root {
        --primary-gradient: linear-gradient(135deg, #40434E 0%, #6f727c 100%);
        --text-dark: #0f172a;
        --text-muted: #64748b;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: #F8F4EF;
        color: var(--text-dark);
    }

    .features-section {
        padding: 100px 0;
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

    /* Styling Kartu Fitur Modern dengan Glassmorphism */
    .feature-card {
        background: rgba(248, 244, 239, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 2.5rem;
        height: 100%;
        border: 1px solid #dfd7ca;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: #40434E;
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
    }

    .feature-card:hover .icon-box {
        background: var(--primary-gradient);
        color: white;
    }

    .icon-box i {
        width: 32px;
        height: 32px;
    }

    .feature-card h3 {
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .feature-card p {
        color: var(--text-muted);
        line-height: 1.7;
        margin-bottom: 0;
    }
</style>

<div class="container features-section">
    <div class="text-center">
        <h1 class="section-title">
            Fitur Unggulan <span class="gradient-text">BALANG</span>
        </h1>
        <p class="section-subtitle">
            Temukan bagaimana platform kami mempermudah proses pencarian dan pelaporan barang hilang secara cerdas.
        </p>
    </div>

    <div class="row g-4">
        <!-- Fitur 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="feature-card">
                <div class="icon-box">
                    <i data-lucide="megaphone"></i>
                </div>
                <h3>Pelaporan Mudah</h3>
                <p>Laporkan barang hilang atau ditemukan dengan cepat melalui formulir yang intuitif dan mudah dipahami.</p>
            </div>
        </div>

        <!-- Fitur 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="feature-card">
                <div class="icon-box">
                    <i data-lucide="search"></i>
                </div>
                <h3>Pencarian Cerdas</h3>
                <p>Filter barang berdasarkan kategori, lokasi, dan tanggal untuk hasil pencarian yang akurat.</p>
            </div>
        </div>

        <!-- Fitur 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="feature-card">
                <div class="icon-box">
                    <i data-lucide="shield-check"></i>
                </div>
                <h3>Verifikasi Valid</h3>
                <p>Sistem verifikasi memastikan laporan asli, memberikan keamanan ekstra bagi semua pengguna.</p>
            </div>
        </div>
        
        <!-- Tambahkan fitur lainnya di sini jika perlu -->
    </div>
</div>

<script>
    // Menginisialisasi ikon Lucide
    lucide.createIcons();
</script>
@endsection
