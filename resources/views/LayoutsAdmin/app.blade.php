<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - BALANG</title>
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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

        /* Navbar Styling */
        .navbar {
            padding: 0.75rem 0;
            background: rgba(248, 244, 239, 0.75) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(223, 215, 202, 0.5);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.02);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
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

        /* User Profile Box */
        .user-profile-box {
            background: rgba(234, 227, 216, 0.6);
            padding: 0.4rem 1.1rem 0.4rem 0.4rem;
            border-radius: 50px;
            gap: 0.75rem;
            border: 1px solid rgba(223, 215, 202, 0.7);
            text-decoration: none;
            color: inherit;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-flex;
            align-items: center;
        }
        
        .user-profile-box:hover {
            background: rgba(220, 211, 196, 0.8);
            border-color: rgba(223, 215, 202, 1);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .avatar-circle {
            width: 34px;
            height: 34px;
            background: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
        }
        
        .user-profile-box:hover .avatar-circle {
            transform: rotate(15deg);
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #2c2e35;
        }

        /* Logout Button */
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(239, 68, 68, 0.06);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.15);
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-logout:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.25);
        }

        main {
            padding-top: 1rem;
        }

        .navbar .container {
            position: relative;
        }

        @media (min-width: 992px) {
            .navbar-nav.mx-auto {
                position: relative;
                left: 0;
                transform: none;
                margin: 0 auto !important;
            }
        }

        /* Mobile Navbar Responsive Design (992px Breakpoint for lg collapse) */
        @media (max-width: 991.98px) {
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
            .d-flex.align-items-center.gap-3.ms-auto {
                margin-top: 1rem;
                padding-top: 1.25rem;
                border-top: 1px solid rgba(223, 215, 202, 0.6);
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
                gap: 1rem !important;
            }
            .user-profile-box {
                width: 100%;
                justify-content: center;
            }
            .btn-logout {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">BALANG</a>
                
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Menu Tengah -->
                    <ul class="navbar-nav mx-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.home') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}" href="{{ route('admin.reports') }}">Semua Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.laporan_selesai') ? 'active' : '' }}" href="{{ route('admin.laporan_selesai') }}">Laporan Selesai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.claims') ? 'active' : '' }}" href="{{ route('admin.claims') }}">Permintaan Klaim</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.history') ? 'active' : '' }}" href="{{ route('admin.history') }}">Riwayat Saya</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}" href="{{ route('admin.profile') }}">Profil</a>
                        </li>
                    </ul>

                    <!-- Menu Kanan -->
                    <div class="d-flex align-items-center gap-3 ms-auto mt-3 mt-lg-0">
                        @auth
                            <a href="{{ route('admin.profile') }}" class="user-profile-box d-flex align-items-center">
                                <div class="avatar-circle">
                                    <i data-lucide="user" style="width: 16px;"></i>
                                </div>
                                <span class="user-name d-none d-sm-inline">{{ explode(' ', Auth::user()->name)[0] }}</span>
                            </a>

                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn-logout">
                                    <i data-lucide="log-out" style="width: 16px;"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
