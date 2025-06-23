@extends('layout.template')

@section('content')

    <!-- Lottie Splash Fullscreen Overlay -->
    <div id="splashOverlay">
        <dotlottie-player id="lottieSplash"
            src="https://lottie.host/68f297ab-61ce-477d-94c6-31a31666d208/fXToysjn9c.lottie"
            background="transparent"
            speed="1"
            autoplay>
        </dotlottie-player>
    </div>

    <!-- Logo Mini Setelah Splash -->
    <dotlottie-player id="lottieLogo"
        src="https://lottie.host/68f297ab-61ce-477d-94c6-31a31666d208/fXToysjn9c.lottie"
        background="transparent"
        speed="1"
        loop
        autoplay>
    </dotlottie-player>

    <!-- Konten utama -->
    <div id="mainContent" style="display: none;">
        <div class="position-relative overflow-hidden" style="background-image: url('/dipakai/bg5.gif'); background-size: cover; background-repeat: no-repeat; background-position: center;">
            <!-- Floating Emojis -->
            <div class="position-absolute top-0 start-0 w-100 h-100 z-0" style="pointer-events: none;">
                <div class="position-absolute top-0 start-0 text-success fs-2 animate-float opacity-25">🌱</div>
                <div class="position-absolute top-50 start-50 text-warning fs-3 animate-float-delayed opacity-20">🌾</div>
                <div class="position-absolute bottom-0 end-0 text-primary fs-1 animate-float-slow opacity-15">🚜</div>
            </div>

            <div class="container py-5 position-relative z-1" style="backdrop-filter: blur(5px); background-color: rgba(255,255,255,0.6); border-radius: 1rem;">
                <!-- Hero -->
                <div class="text-center mb-5">
                    <div class="mb-3">
                        <span class="d-inline-block bg-gradient px-4 py-2 rounded-pill fw-bold text-white shadow"
                              style="background: linear-gradient(135deg, #4CAF50, #CDDC39);">
                            🌾 Selamat Datang di <strong>AgriMap Bantul</strong>
                        </span>
                    </div>
                    <h1 class="display-5 fw-bold text-success drop-shadow">TANDUR</h1>
                    <p class="text-muted fs-5">Tata Lahan dan Data Urun Rancang Sabdodadi</p>
                    <p class="text-dark fs-6">Sistem informasi geografis untuk membantu petani dalam mengelola lahan secara efisien</p>

                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-success btn-lg px-5 me-3 rounded-pill shadow-sm">
                            <i class="fas fa-sign-in-alt me-2"></i> Masuk Dashboard
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg px-5 rounded-pill">
                            <i class="fas fa-user-plus me-2"></i> Daftar Petani
                        </a>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="row mb-5">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-white shadow-sm hover-scale border-start border-success border-4">
                            <div class="card-body text-center">
                                <div class="fs-1 text-success mb-3">🌿</div>
                                <h5 class="fw-bold text-success">Tanaman Terdaftar</h5>
                                <h3>150+</h3>
                                <small class="text-muted">Jenis tanaman aktif</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-white shadow-sm hover-scale border-start border-primary border-4">
                            <div class="card-body text-center">
                                <div class="fs-1 text-primary mb-3">💧</div>
                                <h5 class="fw-bold text-primary">Sistem Irigasi</h5>
                                <h3>25</h3>
                                <small class="text-muted">Jalur perairan aktif</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-white shadow-sm hover-scale border-start border-warning border-4">
                            <div class="card-body text-center">
                                <div class="fs-1 text-warning mb-3">📍</div>
                                <h5 class="fw-bold text-warning">Lahan Pertanian</h5>
                                <h3>75</h3>
                                <small class="text-muted">Area terpetakan</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features -->
                <div class="mb-5">
                    <h4 class="text-success fw-bold mb-4"><i class="fas fa-seedling me-2"></i>Fitur Unggulan</h4>
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="bg-white border border-success border-opacity-25 rounded-4 p-4 shadow-sm hover-scale h-100">
                                <div class="fs-2 mb-3 text-success">🌾</div>
                                <h6 class="fw-bold text-success">Manajemen Tanaman</h6>
                                <p class="small text-muted">Catat dan kelola jenis tanaman dan jadwal tanam.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="bg-white border border-primary border-opacity-25 rounded-4 p-4 shadow-sm hover-scale h-100">
                                <div class="fs-2 mb-3 text-primary">💧</div>
                                <h6 class="fw-bold text-primary">Sistem Perairan</h6>
                                <p class="small text-muted">Kelola irigasi dan pemantauan ketersediaan air.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="bg-white border border-warning border-opacity-25 rounded-4 p-4 shadow-sm hover-scale h-100">
                                <div class="fs-2 mb-3 text-warning">📍</div>
                                <h6 class="fw-bold text-warning">Pemetaan Lahan</h6>
                                <p class="small text-muted">Petakan area pertanian dan analisis spasial.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center mt-5">
                    <p class="text-muted mb-1">
                        <i class="fas fa-leaf me-2 text-success"></i>
                        <strong>TANDUR - Sabdodadi</strong>
                    </p>
                    <p class="text-muted small mb-0">
                        <i class="fas fa-calendar me-1"></i>
                        {{ date('Y') }} | Sistem Informasi Geografis Pertanian
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Lottie -->
    <script type="module" src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"></script>

    <!-- Style -->
    <style>
        #splashOverlay {
            position: fixed;
            top: 0; left: 0;
            width: 100vw;
            height: 100vh;
            background: #f6fff3;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            transition: opacity 1s ease, visibility 1s ease;
        }

        #splashOverlay.hidden {
            opacity: 0;
            visibility: hidden;
        }

        #lottieLogo {
            position: fixed;
            bottom: 1rem;
            left: 1rem;
            width: 60px;
            height: 60px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 1s ease;
        }

        #lottieLogo.visible {
            opacity: 1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(3deg); }
        }

        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(-2deg); }
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(2deg); }
        }

        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delayed { animation: float-delayed 8s ease-in-out infinite; }
        .animate-float-slow { animation: float-slow 10s ease-in-out infinite; }

        .hover-scale { transition: transform 0.3s ease; }
        .hover-scale:hover { transform: scale(1.03); }
        .drop-shadow { text-shadow: 0 2px 4px rgba(0,0,0,0.15); }
        .bg-gradient { background: linear-gradient(90deg, #66BB6A 0%, #AED581 100%); }
    </style>

    <!-- Transition Logic -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const splash = document.getElementById('splashOverlay');
            const logo = document.getElementById('lottieLogo');
            const content = document.getElementById('mainContent');

            setTimeout(() => {
                splash.classList.add('hidden');
                logo.classList.add('visible');
                content.style.display = 'block';
            }, 2500);
        });
    </script>

@endsection
