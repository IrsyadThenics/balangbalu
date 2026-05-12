@extends('LayoutsAdmin.app')

@section('content')
<div class="container" style="margin-top: 5rem; margin-bottom: 5rem;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Permintaan Klaim & Kontak</h2>
            <p class="text-muted mb-0">Validasi bukti dari pengguna sebelum memberikan akses kontak</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted fw-semibold">Waktu</th>
                            <th class="py-3 text-muted fw-semibold">Pemohon</th>
                            <th class="py-3 text-muted fw-semibold">Barang</th>
                            <th class="py-3 text-muted fw-semibold">Pesan Validasi</th>
                            <th class="py-3 text-muted fw-semibold">Status</th>
                            <th class="pe-4 text-end py-3 text-muted fw-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($claims as $claim)
                        <tr>
                            <td class="ps-4">{{ $claim->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <div class="fw-medium">{{ $claim->user->name }}</div>
                                <div class="text-muted small">{{ $claim->user->email }}</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('storage/reports/'.$claim->report->foto_laporan) }}" width="40" height="40" class="rounded shadow-sm" style="object-fit: cover;">
                                    <span class="fw-semibold">{{ $claim->report->nama_laporan }}</span>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 text-truncate" style="max-width: 200px;" title="{{ $claim->pesan_validasi }}">
                                    {{ $claim->pesan_validasi }}
                                </p>
                            </td>
                            <td>
                                @if($claim->status == 'pending')
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">Pending</span>
                                @elseif($claim->status == 'accepted')
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Diterima</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">Ditolak</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <button type="button" class="btn btn-sm btn-light text-primary" data-bs-toggle="modal" data-bs-target="#modalReview{{ $claim->id }}">
                                    Review
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i data-lucide="inbox" class="mb-2" style="width: 48px; height: 48px; opacity: 0.5;"></i>
                                <p>Belum ada permintaan masuk.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($claims as $claim)
<div class="modal fade" id="modalReview{{ $claim->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold">Review Permintaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.claims.update', $claim->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="text-muted text-uppercase fw-bold small d-block mb-1">Barang Terkait</label>
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4">
                            <img src="{{ asset('storage/reports/'.$claim->report->foto_laporan) }}" width="60" height="60" class="rounded-3 shadow-sm" style="object-fit: cover;">
                            <div>
                                <div class="fw-bold">{{ $claim->report->nama_laporan }}</div>
                                <div class="text-muted small">{{ ucfirst($claim->report->jenis_laporan) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted text-uppercase fw-bold small d-block mb-1">Pesan Validasi Pemohon</label>
                        <div class="p-3 border rounded-4 bg-white">
                            {{ $claim->pesan_validasi }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="text-muted text-uppercase fw-bold small d-block mb-1">Keputusan</label>
                        <select name="status" id="status" class="form-select rounded-pill px-3" required>
                            <option value="pending" {{ $claim->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ $claim->status == 'accepted' ? 'selected' : '' }}>Terima (Berikan Akses)</option>
                            <option value="rejected" {{ $claim->status == 'rejected' ? 'selected' : '' }}>Tolak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="catatan_admin" class="text-muted text-uppercase fw-bold small d-block mb-1">Catatan Admin (Opsional)</label>
                        <textarea name="catatan_admin" id="catatan_admin" class="form-control rounded-4" rows="3">{{ $claim->catatan_admin }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Keputusan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
