@extends('layouts.app')
@section('content')
    <style>
        /* Hero Section */
        .hero-section {
            padding: 80px 0 100px;
            text-align: center;
        }

        .hero-title {
            font-weight: 800;
            font-size: clamp(2rem, 10vw, 4.5rem);
            line-height: 1.1;
            letter-spacing: -0.04em;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        .gradient-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 4vw, 1.25rem);
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto 3rem;
            line-height: 1.6;
            padding: 0 15px;
        }

        .hero-btns {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 4rem;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .btn-primary-custom, .btn-secondary-custom {
            width: 100%;
            max-width: 280px;
            justify-content: center;
        }

        @media (min-width: 576px) {
            .btn-primary-custom, .btn-secondary-custom {
                width: auto;
            }
        }

        .btn-primary-custom {
            background: var(--primary-color);
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.4);
            color: white;
        }

        .btn-secondary-custom {
            background: white;
            color: var(--text-dark);
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid #e2e8f0;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .btn-secondary-custom:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Stats/Features */
        .feature-pills {
            display: flex;
            justify-content: center;
            gap: 1.5rem 3rem;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .pill {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .pill i {
            width: 20px;
            height: 20px;
        }

        .pill-aman { color: #10b981; }
        .pill-realtime { color: #f59e0b; }
        .pill-komunitas { color: #3b82f6; }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }

    </style>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title animate-up">
                Temukan barang hilang <br>
                <span class="gradient-text">lebih cepat & aman</span>
            </h1>
            <p class="hero-subtitle animate-up delay-1">
                Platform modern untuk melaporkan dan menemukan barang hilang dengan verifikasi admin dan sistem pencocokan otomatis.
            </p>
            
            <div class="hero-btns animate-up delay-2">
                @auth
                    <a href="{{ route('user.home') }}" class="btn-primary-custom">
                        Ke Dashboard <i data-lucide="arrow-right"></i>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary-custom">
                        Mulai Sekarang <i data-lucide="arrow-right"></i>
                    </a>
                @endauth
                <a href="#fitur" class="btn-secondary-custom">Lihat Fitur</a>
            </div>

            <div class="feature-pills animate-up delay-3">
                <div class="pill">
                    <span class="pill-aman"><i data-lucide="shield-check"></i> Aman</span>
                </div>
                <div class="pill">
                    <span class="pill-realtime"><i data-lucide="zap"></i> Realtime</span>
                </div>
                <div class="pill">
                    <span class="pill-komunitas"><i data-lucide="users"></i> Komunitas</span>
                </div>
            </div>
        </div>
    </section>


@endsection
