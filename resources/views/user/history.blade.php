@extends('LayoutsUser.app')

@section('content')
<style>
    .history-container {
        padding: 2rem 1rem 4rem;
    }
    .page-title {
        font-weight: 800;
        font-size: 1.75rem;
        letter-spacing: -0.025em;
        margin-bottom: 0.25rem;
    }
    .page-subtitle {
        color: #64748b;
        font-size: 1rem;
        margin-bottom: 2.5rem;
    }
    
    .history-card {
        background: #F8F4EF;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .history-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-color: #e2e8f0;
    }

    .history-icon-box {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .bg-red-light { background: #fef2f2; color: #dc2626; }
    .bg-green-light { background: #f0fdf4; color: #16a34a; }

    .history-content {
        flex-grow: 1;
    }

    .history-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #0f172a;
        margin-bottom: 0.25rem;
    }

    .history-meta {
        color: #64748b;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .history-status {
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        white-space: nowrap;
    }
    
    .status-pending { background: #fef9c3; color: #854d0e; }
    .status-resolved { background: #dcfce7; color: #166534; }
</style>

<div class="container history-container">
    <h1 class="page-title">Riwayat Aktivitas</h1>
    <p class="page-subtitle">Daftar riwayat laporan barang hilang atau temuan Anda.</p>

    <div class="history-list">
        @forelse($reports as $report)
        <div class="history-card">
            <div class="history-icon-box {{ $report->jenis_laporan == 'kehilangan' ? 'bg-red-light' : 'bg-green-light' }}">
                <i data-lucide="{{ $report->jenis_laporan == 'kehilangan' ? 'search' : 'check-circle' }}" style="width: 28px; height: 28px;"></i>
            </div>
            <div class="history-content">
                <h3 class="history-title">{{ $report->jenis_laporan == 'kehilangan' ? 'Melaporkan Kehilangan' : 'Melaporkan Temuan' }}: {{ $report->nama_laporan }}</h3>
                <div class="history-meta">
                    <span class="meta-item"><i data-lucide="calendar" style="width: 14px;"></i> {{ \Carbon\Carbon::parse($report->tanggal_laporan)->format('d M Y') }}</span>
                    <span class="meta-item"><i data-lucide="map-pin" style="width: 14px;"></i> {{ $report->lokasi_laporan }}</span>
                </div>
            </div>
            <div>
                <span class="history-status {{ $report->jenis_laporan == 'kehilangan' ? 'status-pending' : 'status-resolved' }}">
                    {{ $report->jenis_laporan == 'kehilangan' ? 'Dalam Pencarian' : 'Selesai Dikembalikan' }}
                </span>
            </div>
        </div>
        @empty
        <div class="text-center py-5">
            <div class="text-muted opacity-50 mb-3"><i data-lucide="inbox" style="width: 48px; height: 48px;"></i></div>
            <p class="text-muted">Belum ada riwayat laporan.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection 
