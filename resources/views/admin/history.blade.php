@extends('LayoutsAdmin.app')

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
    
    /* Navigation Tabs Styling */
    .history-tabs {
        margin-bottom: 2rem;
        border-bottom: 2px solid #dfd7ca;
        padding-bottom: 0.5rem;
     }
     
     .history-tabs .nav-link {
        border: none !important;
        background: transparent !important;
        background-color: transparent !important;
        color: #64748b !important;
        font-weight: 700;
        font-size: 1rem;
        padding: 0.5rem 1.5rem;
        position: relative;
        transition: all 0.2s ease;
        box-shadow: none !important;
        outline: none !important;
     }
     
     .history-tabs .nav-link:hover {
        color: #40434E !important;
        background: transparent !important;
        background-color: transparent !important;
     }
     
     .history-tabs .nav-link.active {
        color: #40434E !important;
        background: transparent !important;
        background-color: transparent !important;
     }
     
     .history-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -0.5rem;
        left: 0;
        right: 0;
        height: 3px;
        background: #40434E !important;
        border-radius: 3px;
     }
    
    .history-card {
        background: #F8F4EF;
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
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
        border-color: #cbd5e1;
    }

    .history-image-box {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
        border: 1px solid #dfd7ca;
    }

    .history-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

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
        flex-wrap: wrap;
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
    .status-rejected { background: #fee2e2; color: #991b1b; }
    
    .catatan-admin-box {
        background-color: rgba(239, 68, 68, 0.05);
        border-left: 3px solid #ef4444;
        padding: 0.5rem 1rem;
        margin-top: 0.5rem;
        border-radius: 0 8px 8px 0;
        font-size: 0.85rem;
    }
    
    .catatan-admin-box.accepted {
        background-color: rgba(34, 197, 94, 0.05);
        border-left-color: #22c55e;
    }
</style>

<div class="container history-container">
    <h1 class="page-title">Riwayat Aktivitas</h1>
    <p class="page-subtitle">Daftar riwayat laporan barang hilang atau temuan Anda.</p>

    <!-- Navigation Pills / Tabs -->
    <ul class="nav history-tabs" id="historyTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports-pane" type="button" role="tab" aria-controls="reports-pane" aria-selected="true">
                Laporan Saya
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="claims-tab" data-bs-toggle="tab" data-bs-target="#claims-pane" type="button" role="tab" aria-controls="claims-pane" aria-selected="false">
                Pengajuan Klaim & Hubungi
            </button>
        </li>
    </ul>

    <div class="tab-content" id="historyTabContent">
        <!-- Panel 1: Laporan Saya -->
        <div class="tab-pane fade show active" id="reports-pane" role="tabpanel" aria-labelledby="reports-tab" tabindex="0">
            <div class="history-list">
                @forelse($reports as $report)
                <div class="history-card">
                    <div class="history-image-box">
                        <img src="{{ asset('storage/reports/'.$report->foto_laporan) }}" class="history-img" alt="{{ $report->nama_laporan }}">
                    </div>
                    <div class="history-content">
                        <h3 class="history-title">{{ $report->jenis_laporan == 'kehilangan' ? 'Melaporkan Kehilangan' : 'Melaporkan Temuan' }}: {{ $report->nama_laporan }}</h3>
                        <div class="history-meta">
                            <span class="meta-item"><i data-lucide="calendar" style="width: 14px;"></i> {{ \Carbon\Carbon::parse($report->tanggal_laporan)->format('d M Y') }}</span>
                            <span class="meta-item"><i data-lucide="map-pin" style="width: 14px;"></i> {{ $report->lokasi_laporan }}</span>
                        </div>
                    </div>
                    <div>
                        @php
                            $latestClaim = $report->claims()->latest()->first();
                        @endphp
                        @if($latestClaim)
                            @if($latestClaim->status == 'accepted')
                                <span class="history-status status-resolved">Selesai</span>
                            @elseif($latestClaim->status == 'pending')
                                <span class="history-status status-pending">Pending</span>
                            @else
                                <span class="history-status status-rejected">Ditolak</span>
                            @endif
                        @else
                            <span class="history-status status-pending">
                                {{ $report->jenis_laporan == 'kehilangan' ? 'Dalam Pencarian' : 'Aktif' }}
                            </span>
                        @endif
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

        <!-- Panel 2: Klaim & Hubungi -->
        <div class="tab-pane fade" id="claims-pane" role="tabpanel" aria-labelledby="claims-tab" tabindex="0">
            <div class="history-list">
                @forelse($claims as $claim)
                <div class="history-card d-flex flex-column align-items-stretch gap-3">
                    <div class="d-flex align-items-center gap-3 w-100">
                        <div class="history-image-box">
                            <img src="{{ asset('storage/reports/'.$claim->report->foto_laporan) }}" class="history-img" alt="{{ $claim->report->nama_laporan }}">
                        </div>
                        <div class="history-content">
                            <h3 class="history-title">
                                {{ $claim->report->jenis_laporan == 'kehilangan' ? 'Menghubungi Pelapor' : 'Mengajukan Klaim' }}: {{ $claim->report->nama_laporan }}
                            </h3>
                            <div class="history-meta">
                                <span class="meta-item"><i data-lucide="calendar" style="width: 14px;"></i> {{ $claim->created_at->format('d M Y') }}</span>
                                <span class="meta-item" title="{{ $claim->pesan_validasi }}"><i data-lucide="message-square" style="width: 14px;"></i> "{{ \Illuminate\Support\Str::limit($claim->pesan_validasi, 60) }}"</span>
                            </div>
                        </div>
                        <div>
                            @if($claim->status == 'pending')
                                <span class="history-status status-pending">Pending</span>
                            @elseif($claim->status == 'accepted')
                                <span class="history-status status-resolved">Selesai</span>
                            @else
                                <span class="history-status status-rejected">Ditolak</span>
                            @endif
                        </div>
                    </div>
                    
                    @if($claim->catatan_admin)
                    <div class="catatan-admin-box {{ $claim->status == 'accepted' ? 'accepted' : '' }}">
                        <strong>Catatan Admin:</strong> {{ $claim->catatan_admin }}
                    </div>
                    @endif
                </div>
                @empty
                <div class="text-center py-5">
                    <div class="text-muted opacity-50 mb-3"><i data-lucide="inbox" style="width: 48px; height: 48px;"></i></div>
                    <p class="text-muted">Belum ada pengajuan klaim atau kontak.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
