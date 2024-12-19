@extends('templates.app')

@section('content')
    <!-- Hero Section -->
    <div class="container-fluid hero-section min-vh-100 position-relative overflow-hidden">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #ffffff 0%, #f5f3ff 100%);"></div>
        <div class="container position-relative">
            <div class="row min-vh-60 align-items-center"> <!-- Changed min-vh-100 to min-vh-75 -->
                <div class="col-lg-6 py-4"> <!-- Reduced padding from py-5 to py-4 -->
                    <div class="hero-content mt-5"> <!-- Added mt-4 margin top -->
                        <span class="badge bg-primary text-white px-4 py-2 mb-4 animate__animated animate__fadeIn">
                            <i class="bi bi-star-fill me-2 text-warning"></i>Platform Pengaduan #1 di Indonesia
                        </span>
                        <h1 class="display-2 fw-bold text-dark mb-4 animate__animated animate__fadeInUp">
                            Suarakan <br>
                            <span class="text-primary">Aspirasi</span> Anda
                        </h1>
                        <p class="lead text-muted mb-5 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.25rem; line-height: 1.8;">
                            Jadilah bagian dari perubahan positif. Bersama-sama kita wujudkan Indonesia 
                            yang lebih baik melalui platform pengaduan yang modern, transparan, dan terpercaya.
                        </p>
                        <div class="d-flex gap-4 animate__animated animate__fadeInUp animate__delay-2s">
                            <a href="{{ route('report.create') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow-lg hover-scale">
                                <i class="bi bi-plus-circle me-2"></i>Buat Laporan
                            </a>
                            <a href="{{ route('report.index') }}" class="btn btn-outline-primary btn-lg px-5 py-3 hover-scale">
                                <i class="bi bi-search me-2"></i>Telusuri Laporan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 position-relative py-4"> <!-- Reduced padding from py-5 to py-4 -->
                    <div class="hero-image position-relative animate__animated animate__fadeInRight">
                        <div class="floating-animation">
                            <img src="{{ asset('assets/images/hero.png') }}" class="img-fluid shadow-lg rounded-4" alt="Hero Illustration">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container py-6">
        <div class="text-center mb-5">
            <span class="badge bg-primary text-white px-4 py-2 mb-3 animate__animated animate__fadeIn">
                <i class="bi bi-stars me-2"></i>Mengapa Memilih Kami?
            </span>
            <h2 class="display-4 fw-bold text-dark mb-4 animate__animated animate__fadeInUp">Fitur Unggulan Kami</h2>
            <p class="text-muted lead mx-auto" style="max-width: 700px; line-height: 1.8;">
                Kami menghadirkan solusi inovatif dan terintegrasi untuk memudahkan proses pengaduan 
                dan monitoring dengan teknologi terkini yang aman dan terpercaya
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 animate__animated animate__fadeInUp">
                <div class="feature-card card border-0 bg-white h-100 p-5 shadow-lg hover-lift">
                    <div class="feature-icon-wrapper mb-4 bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block">
                        <i class="bi bi-lightning-charge-fill fs-2 text-primary"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Pelaporan Cepat</h3>
                    <p class="text-muted mb-4">Proses pelaporan yang simpel dan cepat dengan antarmuka yang intuitif. Laporan Anda akan segera ditindaklanjuti oleh tim kami.</p>
                    <a href="#" class="text-decoration-none stretched-link hover-arrow">
                        <span class="text-primary fw-bold">Pelajari lebih lanjut</span>
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 animate__animated animate__fadeInUp animate__delay-1s">
                <div class="feature-card card border-0 bg-white h-100 p-5 shadow-lg hover-lift">
                    <div class="feature-icon-wrapper mb-4 bg-success bg-opacity-10 rounded-circle p-3 d-inline-block">
                        <i class="bi bi-graph-up-arrow fs-2 text-success"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Monitoring Real-time</h3>
                    <p class="text-muted mb-4">Pantau status laporan secara real-time melalui dashboard interaktif dengan notifikasi langsung ke perangkat Anda.</p>
                    <a href="#" class="text-decoration-none stretched-link hover-arrow">
                        <span class="text-primary fw-bold">Pelajari lebih lanjut</span>
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 animate__animated animate__fadeInUp animate__delay-2s">
                <div class="feature-card card border-0 bg-white h-100 p-5 shadow-lg hover-lift">
                    <div class="feature-icon-wrapper mb-4 bg-warning bg-opacity-10 rounded-circle p-3 d-inline-block">
                        <i class="bi bi-shield-check fs-2 text-warning"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Keamanan Terjamin</h3>
                    <p class="text-muted mb-4">Kerahasiaan data Anda adalah prioritas kami dengan sistem keamanan berlapis dan enkripsi end-to-end.</p>
                    <a href="#" class="text-decoration-none stretched-link hover-arrow">
                        <span class="text-primary fw-bold">Pelajari lebih lanjut</span>
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Statistics Section -->
    <div class="container-fluid bg-gradient py-6" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-3 col-6 animate__animated animate__fadeInUp">
                    <div class="stat-card p-4 rounded-4 bg-white shadow-sm hover-lift">
                        <h2 class="display-4 fw-bold text-primary mb-2 counter">1000+</h2>
                        <p class="text-muted mb-0">Laporan Terselesaikan</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="stat-card p-4 rounded-4 bg-white shadow-sm hover-lift">
                        <h2 class="display-4 fw-bold text-primary mb-2">24/7</h2>
                        <p class="text-muted mb-0">Dukungan Online</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="stat-card p-4 rounded-4 bg-white shadow-sm hover-lift">
                        <h2 class="display-4 fw-bold text-primary mb-2 counter">500+</h2>
                        <p class="text-muted mb-0">Pengguna Aktif</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 animate__animated animate__fadeInUp animate__delay-3s">
                    <div class="stat-card p-4 rounded-4 bg-white shadow-sm hover-lift">
                        <h2 class="display-4 fw-bold text-primary mb-2">98%</h2>
                        <p class="text-muted mb-0">Tingkat Kepuasan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
        }
        .hover-arrow i {
            transition: transform 0.3s ease;
        }
        .hover-arrow:hover i {
            transform: translateX(5px);
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .py-6 {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }
    </style>
@endsection
