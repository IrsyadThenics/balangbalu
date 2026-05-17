@extends('layouts.app')
@section('content')
    <style>
        /* Hero Section Gacor */
        .hero-section {
            padding: 90px 0 110px;
            text-align: center;
            background: linear-gradient(120deg, #F8F4EF 60%, #efeae4 100%);
            border-radius: 0 0 2.5rem 2.5rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }
        .hero-title {
            font-weight: 900;
            font-size: clamp(2.5rem, 8vw, 4.5rem);
            line-height: 1.08;
            letter-spacing: -0.045em;
            margin-bottom: 1.2rem;
            color: #1e293b;
            text-shadow: 0 2px 16px rgba(64,67,78,0.08);
        }
        .gradient-text {
            background: linear-gradient(90deg, #40434E 0%, #6f727c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }
        .hero-subtitle {
            font-size: clamp(1.1rem, 3vw, 1.35rem);
            color: #64748b;
            max-width: 650px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
            padding: 0 15px;
        }
        .hero-btns {
            display: flex;
            gap: 1.2rem;
            justify-content: center;
            margin-bottom: 3.5rem;
            flex-wrap: wrap;
            padding: 0 20px;
        }
        .btn-primary-custom, .btn-secondary-custom {
            width: 100%;
            max-width: 260px;
            justify-content: center;
        }
        @media (min-width: 576px) {
            .btn-primary-custom, .btn-secondary-custom {
                width: auto;
            }
        }
        .btn-primary-custom {
            background: linear-gradient(90deg, #40434E 0%, #6f727c 100%);
            color: #fff;
            padding: 1rem 2.2rem;
            border-radius: 16px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 1.1rem;
            box-shadow: 0 8px 24px -6px #6f727c33;
            border: none;
            transition: all 0.22s cubic-bezier(.4,2,.6,1);
        }
        .btn-primary-custom:hover {
            transform: translateY(-4px) scale(1.04);
            box-shadow: 0 16px 32px -8px #6f727c44;
            background: linear-gradient(90deg, #6f727c 0%, #40434E 100%);
            color: #fff;
        }
        .btn-secondary-custom {
            background: #fff;
            color: #40434E;
            padding: 1rem 2.2rem;
            border-radius: 16px;
            font-weight: 700;
            text-decoration: none;
            border: 2px solid #dfd7ca;
            display: inline-flex;
            align-items: center;
            font-size: 1.1rem;
            transition: all 0.22s cubic-bezier(.4,2,.6,1);
        }
        .btn-secondary-custom:hover {
            background: #efeae4;
            border-color: #6f727c;
            color: #6f727c;
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
            color: #64748b;
            font-weight: 700;
            font-size: 1.05rem;
            background: #fff;
            border-radius: 999px;
            padding: 0.5rem 1.25rem;
            box-shadow: 0 2px 8px 0 #6f727c11;
        }
        .pill i {
            width: 22px;
            height: 22px;
        }
        .pill-aman { color: #40434E; }
        .pill-realtime { color: #40434E; }
        .pill-komunitas { color: #40434E; }
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
            animation: fadeInUp 0.8s cubic-bezier(.4,2,.6,1) forwards;
        }
        .delay-1 { animation-delay: 0.12s; }
        .delay-2 { animation-delay: 0.22s; }
        .delay-3 { animation-delay: 0.32s; }
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
                <a href="{{ route('fitur') }}" class="btn-secondary-custom">Lihat Fitur</a>
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
