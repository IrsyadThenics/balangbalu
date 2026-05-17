<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BALANG - Temukan Barang Hilang</title>

    <!-- Fonts: Menggunakan Inter untuk kesan modern -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles & Scripts (Bootstrap & Vite) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #40434E;
            --primary-gradient: linear-gradient(135deg, #40434E 0%, #6f727c 100%);
            --text-dark: #0f172a;
            --bg-light: #F8F4EF;
        }

        html {
            scrollbar-gutter: stable;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8F4EF;
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* Autofill Overrides */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px #F8F4EF inset !important;
            -webkit-text-fill-color: var(--text-dark) !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .navbar {
            padding: 0.75rem 0;
            background: rgba(248, 244, 239, 0.75) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(223, 215, 202, 0.5);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.02);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .navbar .container {
            position: relative;
        }

        @media (min-width: 768px) {
            .navbar-nav.mx-auto {
                position: relative;
                left: 0;
                transform: none;
                margin: 0 auto !important;
            }
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            background: linear-gradient(135deg, #2c2e35 0%, #40434E 50%, #6f727c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.03em;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.02);
        }

        .nav-link {
            font-weight: 600;
            font-size: 0.95rem;
            color: #575f6e !important;
            padding: 0.6rem 1.1rem !important;
            border-radius: 12px;
            margin: 0 0.2rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }

        .nav-link:hover {
            color: #1e293b !important;
            background-color: rgba(64, 67, 78, 0.05);
        }

        .nav-link.active {
            color: #ffffff !important;
            background-color: #40434E;
            box-shadow: 0 4px 12px rgba(64, 67, 78, 0.15);
        }

        /* Button Customization */
        .btn-primary-nav {
            background-color: var(--primary-color);
            color: white !important;
            font-weight: 600;
            padding: 0.6rem 1.4rem;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(64, 67, 78, 0.2);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary-nav:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(64, 67, 78, 0.3);
            background-color: #2c2e36;
        }

        .dropdown-menu {
            border: 1px solid rgba(223, 215, 202, 0.5);
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            border-radius: 16px;
            padding: 0.5rem;
            background-color: rgba(248, 244, 239, 0.98);
            backdrop-filter: blur(20px);
        }

        .dropdown-item {
            border-radius: 10px;
            font-weight: 600;
            color: #575f6e;
            padding: 0.6rem 1.1rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }
        
        .dropdown-item:hover {
            background-color: rgba(64, 67, 78, 0.05);
            color: #1e293b;
        }

        /* Mobile Navbar Responsive Design */
        @media (max-width: 767.98px) {
            .navbar-collapse {
                background: rgba(248, 244, 239, 0.98);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-radius: 20px;
                padding: 1.5rem;
                margin-top: 1rem;
                box-shadow: 0 12px 40px rgba(0,0,0,0.06);
                border: 1px solid rgba(223, 215, 202, 0.6);
                transition: all 0.3s ease;
            }
            .navbar-nav {
                text-align: center;
                width: 100%;
                gap: 0.5rem;
            }
            .nav-item {
                margin: 0;
                width: 100%;
            }
            .nav-link {
                display: block;
                padding: 0.75rem 1rem !important;
                border-radius: 12px;
                margin: 0 !important;
            }
            .nav-link:hover {
                background-color: rgba(64, 67, 78, 0.05);
            }
            .nav-link.active {
                background-color: #40434E;
                color: #ffffff !important;
            }
            .navbar-nav.ms-auto.align-items-center {
                margin-top: 1rem;
                padding-top: 1.25rem;
                border-top: 1px solid rgba(223, 215, 202, 0.6);
                width: 100%;
                gap: 0.5rem;
            }
            .btn-primary-nav {
                display: flex;
                width: 100%;
                max-width: 100%;
                margin: 0;
            }
            .dropdown-toggle {
                justify-content: center;
                background-color: rgba(64, 67, 78, 0.05);
                border-radius: 12px;
                padding: 0.75rem 1rem !important;
                width: 100%;
            }
            .dropdown-menu {
                position: static !important;
                float: none;
                width: 100%;
                background: transparent;
                box-shadow: none;
                border: none;
                margin-top: 0.5rem;
                padding: 0;
            }
            .dropdown-item {
                justify-content: center;
                background-color: rgba(239, 68, 68, 0.06);
                color: #ef4444;
                border: 1px solid rgba(239, 68, 68, 0.15);
                border-radius: 50px;
                padding: 0.6rem 1.25rem;
            }
            .dropdown-item:hover {
                background-color: #ef4444;
                color: #ffffff;
            }
        }

        main {
            padding-top: 2rem;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    BALANG
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Center Side Of Navbar -->
                    <ul class="navbar-nav mx-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('fitur') ? 'active' : '' }}" href="/fitur">Fitur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('caraKerja') ? 'active' : '' }}" href="/caraKerja">Cara Kerja</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-primary-nav" href="{{ route('login') }}">Masuk</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                        <i data-lucide="user" style="width: 16px;"></i>
                                    </div>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end animate slideIn">
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i data-lucide="log-out" class="me-2" style="width: 16px;"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
              @yield('content')
              @stack('styles')
              @stack('scripts')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Inisialisasi Ikon Lucide
        lucide.createIcons();
    </script>
</body>
</html>
