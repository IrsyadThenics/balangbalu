<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan Baru - BALANG</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg-body: #f8fafc;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .form-card {
            background: white;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            position: relative;
            padding-top: 4px;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-color);
        }

        .card-body {
            padding: 2.5rem;
        }

        .title {
            font-weight: 800;
            font-size: 1.75rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label i {
            width: 16px;
            height: 16px;
            color: var(--primary-color);
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            background-color: #fcfcfd;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background-color: white;
        }

        .btn-submit {
            background-color: var(--primary-color);
            border: none;
            color: white;
            font-weight: 700;
            padding: 0.875rem;
            border-radius: 12px;
            width: 100%;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.4);
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 1.25rem;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: var(--text-dark);
        }

        .image-preview-container {
            width: 100%;
            height: 200px;
            border: 2px dashed var(--border-color);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 0.5rem;
            overflow: hidden;
            background: #fcfcfd;
            position: relative;
        }

        .image-preview-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .preview-placeholder {
            text-align: center;
            color: var(--text-muted);
        }

        .preview-placeholder i {
            width: 48px;
            height: 48px;
            margin-bottom: 0.5rem;
            opacity: 0.5;
        }

        .alert {
            border-radius: 12px;
            font-size: 0.9rem;
            border: none;
        }

        .row-gap {
            margin-bottom: 1.25rem;
        }
    </style>
</head>
<body>

    <div class="form-card">
        <div class="card-body">
            <h1 class="title">Buat Laporan Baru</h1>
            <p class="subtitle">Berikan detail lengkap agar pencocokan barang lebih akurat.</p>

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row-gap">
                    <label for="nama_laporan" class="form-label">
                        <i data-lucide="tag"></i> Nama Barang / Laporan
                    </label>
                    <input type="text" class="form-control" id="nama_laporan" name="nama_laporan" value="{{ old('nama_laporan') }}" placeholder="Contoh: Kunci Motor Honda, Dompet Hitam" required>
                </div>

                <div class="row">
                    <div class="col-md-6 row-gap">
                        <label for="jenis_laporan" class="form-label">
                            <i data-lucide="layers"></i> Jenis Laporan
                        </label>
                        <select class="form-select" name="jenis_laporan" id="jenis_laporan" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="kehilangan" {{ old('jenis_laporan') == 'kehilangan' ? 'selected' : '' }}>Kehilangan</option>
                            <option value="menemukan" {{ old('jenis_laporan') == 'menemukan' ? 'selected' : '' }}>Menemukan</option>
                        </select>
                    </div>
                    <div class="col-md-6 row-gap">
                        <label for="lokasi_laporan" class="form-label">
                            <i data-lucide="map-pin"></i> Lokasi Kejadian
                        </label>
                        <input type="text" class="form-control" id="lokasi_laporan" name="lokasi_laporan" value="{{ old('lokasi_laporan') }}" placeholder="Contoh: Kantin, Parkiran" required>
                    </div>
                </div>

                <div class="row-gap">
                    <label for="deskripsi_laporan" class="form-label">
                        <i data-lucide="align-left"></i> Deskripsi Detail
                    </label>
                    <textarea class="form-control" id="deskripsi_laporan" name="deskripsi_laporan" rows="3" placeholder="Jelaskan ciri-ciri khusus barang tersebut..." required>{{ old('deskripsi_laporan') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 row-gap">
                        <label for="tanggal_laporan" class="form-label">
                            <i data-lucide="calendar"></i> Tanggal
                        </label>
                        <input type="date" class="form-control" id="tanggal_laporan" name="tanggal_laporan" value="{{ old('tanggal_laporan') }}" required>
                    </div>
                    <div class="col-md-6 row-gap">
                        <label for="waktu_laporan" class="form-label">
                            <i data-lucide="clock"></i> Waktu
                        </label>
                        <input type="time" class="form-control" id="waktu_laporan" name="waktu_laporan" value="{{ old('waktu_laporan') }}" required>
                    </div>
                </div>

                <div class="row-gap">
                    <label for="foto_laporan" class="form-label">
                        <i data-lucide="image"></i> Foto Barang
                    </label>
                    <input type="file" class="form-control" id="foto_laporan" name="foto_laporan" accept="image/*" required onchange="previewImage(this)">
                    <div class="image-preview-container" id="imagePreviewContainer">
                        <div class="preview-placeholder">
                            <i data-lucide="upload-cloud"></i>
                            <p class="mb-0 small">Pratinjau foto akan muncul di sini</p>
                        </div>
                        <img src="" alt="Preview" id="previewImg">
                    </div>
                </div>

                <button type="submit" class="btn-submit">Kirim Laporan</button>
                <a href="{{ auth()->user()->role == 'admin' ? route('admin.home') : route('user.home') }}" class="btn-back">Batal & Kembali</a>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        lucide.createIcons();

        function previewImage(input) {
            const previewImg = document.getElementById('previewImg');
            const placeholder = document.querySelector('.preview-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                    placeholder.style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
