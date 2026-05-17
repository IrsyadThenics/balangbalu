<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - BALANG</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #40434E;
            --primary-hover: #2c2e36;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg-light: #F8F4EF;
            --border-color: #dfd7ca;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #F8F4EF;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 40px 20px;
        }

        .register-card {
            background: #efeae4;
            width: 100%;
            max-width: 480px;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            position: relative;
            padding-top: 4px;
        }

        .register-card::before {
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
        }

        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            background-color: #F8F4EF;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(64, 67, 78, 0.1);
            background-color: #efeae4;
        }

        /* Autofill Overrides */
        .form-control:-webkit-autofill,
        .form-control:-webkit-autofill:hover, 
        .form-control:-webkit-autofill:focus, 
        .form-control:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px #F8F4EF inset !important;
            -webkit-text-fill-color: var(--text-dark) !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .btn-register {
            background-color: var(--primary-color);
            border: none;
            color: white;
            font-weight: 700;
            padding: 0.875rem;
            border-radius: 12px;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(64, 67, 78, 0.2);
        }

        .btn-register:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(64, 67, 78, 0.3);
        }

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .footer-text a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            font-size: 0.9rem;
            border: none;
        }
    </style>
</head>
<body>

    <div class="register-card">
        <div class="card-body">
            <h1 class="title">Daftar Akun</h1>
            <p class="subtitle">Buat akun BALANG untuk mulai melapor</p>

            @if($errors->any())
                <div class="alert alert-danger mb-4 py-2">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama lengkap" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="nama@email.com" required value="{{ old('email') }}">
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-register">Daftar Sekarang</button>
            </form>

            <div class="footer-text">
                Sudah punya akun? <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>

</body>
</html>
