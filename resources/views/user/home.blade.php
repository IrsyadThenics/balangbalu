@extends('LayoutsUser.app')

@section('content')
<style>
    /* Custom CSS khusus untuk halaman Dashboard */
    :root {
        --primary-light: #eff6ff;
        --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    }

    .dashboard-container {
        padding: 2rem 0 4rem;
    }

    .welcome-section {
        margin-bottom: 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 1.5rem;
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

    .btn-create {
        background-color: #2563eb;
        color: white;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
    }

    .btn-create:hover {
        background-color: #1d4ed8;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.4);
    }

    /* Stats Cards */
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 1.25rem;
        box-shadow: var(--card-shadow);
        border: 1px solid #f1f5f9;
        height: 100%;
        transition: transform 0.2s ease;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .icon-blue { background: #eff6ff; color: #2563eb; }
    .icon-red { background: #fef2f2; color: #dc2626; }
    .icon-green { background: #f0fdf4; color: #16a34a; }

    .stat-value { font-weight: 800; font-size: 1.5rem; margin-bottom: 0.25rem; }
    .stat-label { color: #64748b; font-size: 0.875rem; font-weight: 500; }

    /* Report Cards */
    .report-card {
        background: white;
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
        gap: 0.75rem;
        background: #fcfcfd;
        border-top: 1px solid #f1f5f9;
    }

    .btn-action-main {
        flex: 2;
        padding: 0.6rem;
        border-radius: 10px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .btn-hubungi { background: #fee2e2; color: #dc2626; }
    .btn-klaim { background: #dcfce7; color: #16a34a; }

    .btn-detail-icon {
        width: 40px;
        height: 40px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .owner-actions {
        position: absolute;
        top: 1rem;
        left: 1rem;
        display: flex;
        gap: 0.5rem;
        z-index: 10;
    }

    .btn-mini-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        backdrop-filter: blur(8px);
    }

    .btn-mini-edit { background: rgba(255, 255, 255, 0.9); color: #a16207; }
    .btn-mini-delete { background: rgba(255, 255, 255, 0.9); color: #b91c1c; }

    /* Modal */
    .modal-content { border-radius: 24px; border: none; }
    .detail-label { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; color: #64748b; display: block; }
    .detail-value { font-weight: 600; color: #0f172a; margin-bottom: 1.25rem; }
    .detail-img { width: 100%; border-radius: 16px; object-fit: cover; max-height: 400px; }
</style>

<div class="container dashboard-container">
    <!-- Welcome -->
    <div class="welcome-section">
        <div>
            <h1 class="welcome-title">Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
            <p class="welcome-subtitle mb-0">Pantau dan kelola laporan barang hilang atau temuan Anda.</p>
        </div>
        <a href="{{ route('reports.create') }}" class="btn-create">
            <i data-lucide="plus" style="width: 20px;"></i>
            Buat Laporan Baru
        </a>
    </div>
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i data-lucide="check-circle" style="width: 20px;"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4 border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i data-lucide="alert-circle" style="width: 20px;"></i>
                {{ session('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Stats -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-blue"><i data-lucide="clipboard-list"></i></div>
                <div class="stat-value">{{ $reports->count() }}</div>
                <div class="stat-label">Total Laporan</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-red"><i data-lucide="search"></i></div>
                <div class="stat-value">{{ $reports->where('jenis_laporan', 'kehilangan')->count() }}</div>
                <div class="stat-label">Barang Kehilangan</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-green"><i data-lucide="check-circle"></i></div>
                <div class="stat-value">{{ $reports->where('jenis_laporan', 'menemukan')->count() }}</div>
                <div class="stat-label">Barang Ditemukan</div>
            </div>
        </div>
    </div>

    <!-- Reports Cards Grid -->
    <div class="row g-4">
        @forelse($reports as $report)
        <div class="col-lg-4 col-md-6">
            <div class="report-card">
                <span class="type-badge {{ $report->jenis_laporan == 'kehilangan' ? 'badge-kehilangan' : 'badge-menemukan' }}">
                    {{ $report->jenis_laporan }}
                </span>

                @if((int)$report->user_id == (int)auth()->id())
                <div class="owner-actions">
                    <a href="{{ route('reports.edit', $report->id) }}" class="btn-mini-action btn-mini-edit" title="Edit">
                        <i data-lucide="edit-2" style="width: 14px;"></i>
                    </a>
                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-mini-action btn-mini-delete" title="Hapus">
                            <i data-lucide="trash-2" style="width: 14px;"></i>
                        </button>
                    </form>
                </div>
                @endif
                
                <div class="card-img-wrapper">
                    <img src="{{ asset('storage/reports/'.$report->foto_laporan) }}" class="card-img-top" alt="{{ $report->nama_laporan }}">
                </div>

                <div class="card-content">
                    <h3 class="report-name">{{ $report->nama_laporan }}</h3>
                    <div class="info-item">
                        <i data-lucide="map-pin" style="width: 16px; color: #2563eb;"></i>
                        {{ $report->lokasi_laporan }}
                    </div>
                    <div class="info-item">
                        <i data-lucide="calendar" style="width: 16px; color: #2563eb;"></i>
                        {{ \Carbon\Carbon::parse($report->tanggal_laporan)->format('d M Y') }}
                    </div>
                </div>

                <div class="card-footer-custom">
                    @if($report->jenis_laporan == 'kehilangan')
                    <button type="button" class="btn-action-main btn-hubungi" data-bs-toggle="modal" data-bs-target="#modalClaim{{ $report->id }}">Hubungi</button>
                    @else
                    <button type="button" class="btn-action-main btn-klaim" data-bs-toggle="modal" data-bs-target="#modalClaim{{ $report->id }}">Klaim</button>
                    @endif

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Claim -->
        <div class="modal fade" id="modalClaim{{ $report->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 px-4 pt-4">
                        <h5 class="modal-title fw-800">
                            {{ $report->jenis_laporan == 'kehilangan' ? 'Hubungi Pelapor' : 'Klaim Barang' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('claims.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                        <div class="modal-body p-4">
                            <p class="text-muted mb-4">
                                {{ $report->jenis_laporan == 'kehilangan' ? 
                                   'Berikan informasi atau bukti jika Anda menemukan barang ini.' : 
                                   'Berikan deskripsi atau bukti yang kuat bahwa barang ini adalah milik Anda.' }}
                            </p>
                            <div class="mb-3">
                                <label for="pesan_validasi" class="detail-label">Pesan / Bukti Validasi</label>
                                <textarea name="pesan_validasi" id="pesan_validasi" class="form-control" rows="4" placeholder="Contoh: Saya menemukan barang ini di dekat kantin..." required minlength="10"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer border-0 p-4">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Kirim Permintaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted opacity-50 mb-3"><i data-lucide="inbox" style="width: 48px; height: 48px;"></i></div>
            <p class="text-muted">Belum ada laporan yang tersedia.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection