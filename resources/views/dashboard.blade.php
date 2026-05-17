@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h1 class="mb-4 text-center">Dashboard</h1>
                    <p class="lead text-center">Selamat datang di aplikasi BalangBalu!<br>Gunakan menu di samping untuk mengakses fitur utama.</p>
                    <div class="row mt-5 text-center">
                        <div class="col-6 col-md-3 mb-4">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <i class="bi bi-people fs-1 text-primary"></i>
                                <div class="fw-bold mt-2">Pengguna</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <i class="bi bi-file-earmark-text fs-1 text-success"></i>
                                <div class="fw-bold mt-2">Laporan</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <i class="bi bi-cash-coin fs-1 text-warning"></i>
                                <div class="fw-bold mt-2">Klaim</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <i class="bi bi-gear fs-1 text-danger"></i>
                                <div class="fw-bold mt-2">Pengaturan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
