@extends('LayoutsAdmin.app')

@section('content')
<div class="container" style="margin-top: 5rem; margin-bottom: 5rem;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Daftar Laporan</h2>
            <p class="text-muted mb-0">Kelola semua laporan barang hilang dan temuan dari pengguna</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted fw-semibold">ID</th>
                            <th class="py-3 text-muted fw-semibold">Pelapor</th>
                            <th class="py-3 text-muted fw-semibold">Barang</th>
                            <th class="py-3 text-muted fw-semibold">Jenis</th>
                            <th class="py-3 text-muted fw-semibold">Lokasi</th>
                            <th class="py-3 text-muted fw-semibold">Waktu Dilaporkan</th>
                            <th class="pe-4 text-end py-3 text-muted fw-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report) 
                        <tr>
                            <td class="ps-4">#{{ str_pad($report->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                @php
                                    $user = \App\Models\User::find($report->user_id);
                                @endphp
                                <span class="fw-medium">{{ $user ? $user->name : 'Unknown' }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden;">
                                        <img src="{{ asset('storage/reports/'.$report->foto_laporan) }}" class="w-100 h-100" style="object-fit: cover;" alt="">
                                    </div>
                                    <span class="fw-semibold">{{ $report->nama_laporan }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $report->jenis_laporan == 'kehilangan' ? 'bg-danger' : 'bg-success' }} bg-opacity-10 text-{{ $report->jenis_laporan == 'kehilangan' ? 'danger' : 'success' }} px-3 py-2 rounded-pill">
                                    {{ ucfirst($report->jenis_laporan) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $report->lokasi_laporan }}">
                                    {{ $report->lokasi_laporan }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($report->tanggal_laporan)->format('d M Y') }}</td>
                            <td class="text-end pe-4">
                                <button type="button" class="btn btn-sm btn-light text-primary" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $report->id }}">
                                    <i data-lucide="eye" style="width: 16px; height: 16px;"></i> Detail
                                </button>
                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger">
                                        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <div class="mb-3">
                                    <i data-lucide="inbox" style="width: 48px; height: 48px; opacity: 0.5;"></i>
                                </div>
                                Belum ada laporan yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modals for details -->
@foreach($reports as $report)
<div class="modal fade" id="modalDetail{{ $report->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold">{{ $report->nama_laporan }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/reports/'.$report->foto_laporan) }}" class="w-100 rounded" style="object-fit: cover; max-height: 400px;" alt="foto">
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Jenis Laporan</h6>
                        <div class="mb-3">
                            <span class="badge {{ $report->jenis_laporan == 'kehilangan' ? 'bg-danger' : 'bg-success' }} px-3 py-2 rounded-pill">
                                {{ strtoupper($report->jenis_laporan) }}
                            </span>
                        </div>
                        <h6 class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Deskripsi</h6>
                        <p class="fw-medium mb-3">{{ $report->deskripsi_laporan }}</p>
                        <h6 class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Lokasi</h6>
                        <p class="fw-medium mb-3">{{ $report->lokasi_laporan }}</p>
                        <h6 class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Waktu</h6>
                        <p class="fw-medium">
                            {{ \Carbon\Carbon::parse($report->tanggal_laporan)->format('d F Y') }}
                        </p>
                        <h6 class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem; mt-3">Pelapor</h6>
                        @php $pelapor = \App\Models\User::find($report->user_id); @endphp
                        <p class="fw-medium mb-0">
                            {{ $pelapor ? $pelapor->name : 'Unknown' }} <br>
                            <span class="text-muted" style="font-size: 0.85rem;">{{ $pelapor ? $pelapor->email : '' }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
