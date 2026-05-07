@extends('LayoutsUser.app')

@section('content')
<style>
    .profile-container {
        padding: 2rem 0 4rem;
    }
    
    .profile-header {
        background: white;
        border-radius: 24px;
        padding: 3rem 2rem;
        text-align: center;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 120px;
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
        z-index: 0;
    }

    .avatar-large {
        width: 120px;
        height: 120px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: #2563eb;
        position: relative;
        z-index: 1;
        border: 4px solid white;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .profile-name {
        font-weight: 800;
        font-size: 2rem;
        color: #0f172a;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .profile-email {
        color: #64748b;
        font-size: 1.1rem;
        position: relative;
        z-index: 1;
    }

    .info-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        height: 100%;
    }

    .info-card-title {
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
    }

    .form-control {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.2s;
    }

    .form-control:focus {
        background-color: white;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .btn-save {
        background-color: #2563eb;
        color: white;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 12px;
        transition: all 0.2s;
        border: none;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .btn-save:hover {
        background-color: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(37, 99, 235, 0.3);
    }
</style>

<div class="container profile-container">
    <!-- Header Profil -->
    <div class="profile-header">
        <div class="avatar-large">
            <i data-lucide="user" style="width: 64px; height: 64px;"></i>
        </div>
        <h1 class="profile-name">{{ Auth::user()->name }}</h1>
        <p class="profile-email">{{ Auth::user()->email }}</p>
    </div>

    <!-- Konten Detail Profil -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Form Informasi Pribadi -->
        <div class="col-lg-8">
            <div class="info-card">
                <h3 class="info-card-title">
                    <i data-lucide="user-cog" style="color: #2563eb;"></i> 
                    Informasi Akun
                </h3>
                
                <form action="{{ route('user.profile.update') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly disabled>
                            <small class="text-muted mt-1 d-block">Email tidak dapat diubah.</small>
                        </div>
                        <!-- Tambahkan field lain jika ada di database (misal no. telp) -->
                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn-save">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Keamanan / Ganti Password -->
        <div class="col-lg-4">
            <div class="info-card">
                <h3 class="info-card-title">
                    <i data-lucide="shield" style="color: #2563eb;"></i>
                    Keamanan
                </h3>
                <p class="text-muted mb-4 text-sm">Ubah kata sandi Anda secara berkala untuk menjaga keamanan akun.</p>
                <form action="{{ route('user.password.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Kata Sandi Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="btn-save w-100">Perbarui Sandi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
