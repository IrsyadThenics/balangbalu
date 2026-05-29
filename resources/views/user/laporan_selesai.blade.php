@extends('LayoutsUser.app')

@section('content')
<style>
    :root {
        --primary-light: #eff6ff;
        --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    }

    .dashboard-container {
        padding: 2rem 1rem 4rem;
    }

    .welcome-section {
        margin-bottom: 2.5rem;
    }

    .welcome-title {
        font-weight: 800;
        font-size: 1.75rem;
        letter-spacing: -0.025em;
        margin-bottom: 0.25rem;
    }

    .welcome-subtitle {
        color: #64748b;
        font-size: 1rem;
    }

    /* Report Cards */
    .report-card {
        background: #F8F4EF;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .report-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.03);
        border-color: #cbd5e1;
    }

    .card-img-wrapper {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .type-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
        z-index: 10;
    }

    .badge-kehilangan { background: #ef4444; color: white; }
    .badge-menemukan { background: #22c55e; color: white; }

    .card-content { padding: 1.5rem; flex-grow: 1; }
    .report-name { font-weight: 800; font-size: 1.15rem; color: #0f172a; }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        color: #64748b;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }

    .card-footer-custom {
        padding: 1.25rem 1.5rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fcfcfd;
        border-top: 1px solid #dfd7ca;
    }

    .btn-detail-icon {
        width: 40px;
        height: 40px;
        background: #F8F4EF;
        border: 1px solid #dfd7ca;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-detail-icon:hover {
        background: #efeae4;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    .resolved-badge {
        background: rgba(34, 197, 94, 0.1);
        color: #166534;
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* Modal */
    .modal-content { border-radius: 24px; border: none; }
    .detail-label { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; color: #64748b; display: block; }
    .detail-value { font-weight: 600; color: #0f172a; margin-bottom: 1.25rem; }
    .detail-img { width: 100%; border-radius: 16px; object-fit: cover; max-height: 400px; }
</style>

<div class="container dashboard-container">
    <div class="welcome-section">
        <h1 class="welcome-title">Laporan Selesai 🎉</h1>
        <p class="welcome-subtitle mb-0">Daftar laporan barang hilang atau temuan yang telah sukses diselesaikan/dikembalikan.</p>
    </div>

    <!-- Reports Cards Grid -->
    <div class="row g-4">
        @forelse($reports as $report)
        <div class="col-lg-4 col-md-6">
            <div class="report-card">
                <span class="type-badge {{ $report->jenis_laporan == 'kehilangan' ? 'badge-kehilangan' : 'badge-menemukan' }}">
                    {{ $report->jenis_laporan }}
                </span>
                
                <div class="card-img-wrapper">
                    <img src="{{ asset('storage/reports/'.$report->foto_laporan) }}" class="card-img-top" alt="{{ $report->nama_laporan }}">
                </div>

                <div class="card-content">
                    <h3 class="report-name">{{ $report->nama_laporan }}</h3>
                    <div class="info-item">
                        <i data-lucide="map-pin" style="width: 16px; color: #40434E;"></i>
                        {{ $report->lokasi_laporan }}
                    </div>
                    <div class="info-item">
                        <i data-lucide="calendar" style="width: 16px; color: #40434E;"></i>
                        {{ \Carbon\Carbon::parse($report->tanggal_laporan)->format('d M Y') }}
                    </div>
                </div>

                <div class="card-footer-custom">
                    <span class="resolved-badge">
                        <i data-lucide="check-circle-2" style="width: 16px;"></i>
                        Selesai Dikembalikan
                    </span>

                    <button type="button" class="btn-detail-icon" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $report->id }}">
                        <i data-lucide="eye" style="width: 18px;"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Detail -->
        <div class="modal fade" id="modalDetail{{ $report->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0 px-4 pt-4">
                        <h5 class="modal-title fw-800">{{ $report->nama_laporan }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <img src="{{ asset('storage/reports/'.$report->foto_laporan) }}" class="detail-img" alt="foto">
                            </div>
                            <div class="col-md-6">
                                <span class="detail-label">Jenis Laporan</span>
                                <div class="mb-4">
                                    <span class="badge {{ $report->jenis_laporan == 'kehilangan' ? 'bg-danger' : 'bg-success' }} px-3 py-2 rounded-pill">
                                        {{ strtoupper($report->jenis_laporan) }}
                                    </span>
                                </div>
                                <span class="detail-label">Deskripsi</span>
                                <p class="detail-value">{{ $report->deskripsi_laporan }}</p>
                                <span class="detail-label">Lokasi</span>
                                <p class="detail-value">{{ $report->lokasi_laporan }}</p>
                                <span class="detail-label">Waktu</span>
                                <p class="detail-value">
                                    {{ \Carbon\Carbon::parse($report->tanggal_laporan)->format('d F Y') }}
                                </p>
                                <span class="detail-label">Status</span>
                                <div class="resolved-badge mt-1">
                                    <i data-lucide="check-circle-2" style="width: 16px;"></i>
                                    Selesai Dikembalikan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted opacity-50 mb-3"><i data-lucide="check-square" style="width: 48px; height: 48px;"></i></div>
            <p class="text-muted">Belum ada laporan selesai.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
