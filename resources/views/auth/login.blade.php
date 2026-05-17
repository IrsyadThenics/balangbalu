<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BALANG</title>
    
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
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-card {
            background: #efeae4;
            width: 100%;
            max-width: 420px;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            position: relative;
            padding-top: 4px; /* Space for the top bar */
        }
        
        /* Top accent bar */
        .login-card::before {
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

        .login-title {
            font-weight: 800;
            font-size: 1.75rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        .login-subtitle {
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

        .btn-login {
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

        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(64, 67, 78, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
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

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 500;
            border: none;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #b91c1c;
        }

        .alert-success {
            background-color: #f0fdf4;
            color: #15803d;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .card-body {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="card-body">
            <h1 class="login-title">Login</h1>
            <p class="login-subtitle">Masuk ke akun BALANG kamu</p>

            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="email@gmail.com" required value="{{ old('email') }}">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <div class="footer-text">
                Belum punya akun? <a href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </div>

</body>
</html>
