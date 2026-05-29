@extends('LayoutsUser.app')

@section('content')
<style>
    /* Custom CSS khusus untuk halaman Dashboard */
    :root {
        --primary-light: #eff6ff;
        --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    }

    .dashboard-container {
        padding: 2rem 1rem 4rem;
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
        background-color: #40434E;
        color: white;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        box-shadow: 0 10px 15px -3px rgba(64, 67, 78, 0.3);
    }

    .btn-create:hover {
        background-color: #2c2e36;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(64, 67, 78, 0.4);
    }

    /* Stats Cards */
    .stat-card {
        background: #F8F4EF;
        padding: 1.5rem;
        border-radius: 1.25rem;
        box-shadow: var(--card-shadow);
        border: 1px solid #f1f5f9;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.1);
        border-color: #cbd5e1;
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

    .icon-blue { background: #eae3d8; color: #40434E; }
    .icon-red { background: #fef2f2; color: #dc2626; }
    .icon-green { background: #f0fdf4; color: #16a34a; }

    .stat-value { font-weight: 800; font-size: 1.5rem; margin-bottom: 0.25rem; }
    .stat-label { color: #64748b; font-size: 0.875rem; font-weight: 500; }

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
        gap: 0.75rem;
        background: #fcfcfd;
        border-top: 1px solid #dfd7ca;
    }

    .btn-action-main {
        flex: 2;
        padding: 0.6rem;
        border-radius: 10px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        font-size: 0.9rem;
        border: none;
        transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-action-main:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        opacity: 0.9;
    }

    .btn-hubungi { background: #fee2e2; color: #dc2626; }
    .btn-klaim { background: #dcfce7; color: #16a34a; }

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

    .btn-mini-edit { background: rgba(248, 244, 239, 0.9); color: #a16207; }
    .btn-mini-delete { background: rgba(248, 244, 239, 0.9); color: #b91c1c; }

    /* Modal */
    .modal-content { border-radius: 24px; border: none; }
    .detail-label { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; color: #64748b; display: block; }
    .detail-value { font-weight: 600; color: #0f172a; margin-bottom: 1.25rem; }
    .detail-img { width: 100%; border-radius: 16px; object-fit: cover; max-height: 400px; }

    /* Responsive Stats Cards (Side by Side on Mobile) */
    @media (max-width: 767.98px) {
        .stat-card {
            padding: 0.75rem 0.35rem;
            border-radius: 1rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .stat-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            margin-bottom: 0.4rem;
        }
        
        .stat-icon i {
            width: 14px;
            height: 14px;
        }

        .stat-value {
            font-size: 1.1rem;
            margin-bottom: 0.1rem;
        }

        .stat-label {
            font-size: 0.65rem;
            line-height: 1.15;
        }
    }
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
    <div class="row g-2 g-md-4 mb-5">
        <div class="col-4 col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-blue"><i data-lucide="clipboard-list"></i></div>
                <div class="stat-value">{{ $reports->count() }}</div>
                <div class="stat-label">Total Laporan</div>
            </div>
        </div>
        <div class="col-4 col-md-4">
            <div class="stat-card">
                <div class="stat-icon icon-red"><i data-lucide="search"></i></div>
                <div class="stat-value">{{ $reports->where('jenis_laporan', 'kehilangan')->count() }}</div>
                <div class="stat-label">Barang Kehilangan</div>
            </div>
        </div>
        <div class="col-4 col-md-4">
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
                        <i data-lucide="map-pin" style="width: 16px; color: #40434E;"></i>
                        {{ $report->lokasi_laporan }}
                    </div>
                    <div class="info-item">
                        <i data-lucide="calendar" style="width: 16px; color: #40434E;"></i>
                        {{ \Carbon\Carbon::parse($report->tanggal_laporan)->format('d M Y') }}
                    </div>
                </div>

                <div class="card-footer-custom">
                    @if((int)$report->user_id !== (int)auth()->id())
                        @if($report->jenis_laporan == 'kehilangan')
                        <button type="button" class="btn-action-main btn-hubungi" data-bs-toggle="modal" data-bs-target="#modalClaim{{ $report->id }}">Hubungi</button>
                        @else
                        <button type="button" class="btn-action-main btn-klaim" data-bs-toggle="modal" data-bs-target="#modalClaim{{ $report->id }}">Klaim</button>
                        @endif
                    @else
                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill fw-bold w-100 text-center" style="font-size: 0.8rem; line-height: 1.5;">
                            Laporan Anda
                        </span>
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
                    <form action="{{ route('claims.store') }}" method="POST" enctype="multipart/form-data">
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
                                <textarea name="pesan_validasi" id="pesan_validasi" class="form-control rounded-4" rows="3" placeholder="Contoh: Saya menemukan barang ini di dekat kantin..." required minlength="10"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="no_wa" class="detail-label">Nomor WhatsApp Anda</label>
                                <input type="tel" name="no_wa" id="no_wa" class="form-control rounded-pill px-3" placeholder="Contoh: 081234567890" required pattern="[0-9]{9,15}">
                                <small class="text-muted d-block mt-1">Masukkan nomor WhatsApp aktif Anda agar admin dapat menghubungi Anda.</small>
                            </div>

                            <div class="mb-4">
                                <label for="bukti_gambar" class="detail-label">Foto / Gambar Bukti (Opsional)</label>
                                <input type="file" name="bukti_gambar" id="bukti_gambar" class="form-control rounded-4" accept="image/*">
                                <small class="text-muted d-block mt-1">Unggah foto pendukung atau bukti kepemilikan/temuan barang jika ada.</small>
                            </div>

                            <!-- Arahan Hubungi Admin -->
                            <div class="p-3 bg-light rounded-4 border border-opacity-10 d-flex flex-column gap-2 mb-2" style="background-color: #f0fdf4 !important; border-color: #bbf7d0 !important;">
                                <div class="d-flex align-items-start gap-2">
                                    <i data-lucide="help-circle" class="text-success mt-1" style="width: 18px; flex-shrink: 0;"></i>
                                    <div>
                                        <span class="fw-bold text-success" style="font-size: 0.85rem; display: block;">Butuh Bantuan Cepat?</span>
                                        <p class="text-muted mb-0" style="font-size: 0.8rem; line-height: 1.4;">
                                            Anda juga dapat langsung menghubungi Admin melalui WhatsApp untuk mempercepat proses verifikasi barang ini.
                                        </p>
                                    </div>
                                </div>
                                <a href="https://wa.me/6285607746795?text=Halo%20Admin,%20saya%20ingin%20bertanya%20mengenai%20klaim%20barang%20laporan%20ID%20{{ $report->id }}%20({{ urlencode($report->nama_laporan) }})." target="_blank" class="btn btn-success btn-sm w-100 rounded-pill fw-bold py-2 mt-1 d-flex align-items-center justify-content-center gap-2" style="background-color: #22c55e; border: none;">
                                    <i data-lucide="message-circle" style="width: 16px;"></i> Hubungi Admin via WhatsApp
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer border-0 p-4 pt-0">
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
