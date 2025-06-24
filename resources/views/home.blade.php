@extends('layout.template')

@section('content')
    <!-- Lottie Splash Fullscreen Overlay -->
    <div id="splashOverlay">
        <dotlottie-player id="lottieSplash" src="https://lottie.host/68f297ab-61ce-477d-94c6-31a31666d208/fXToysjn9c.lottie"
            background="transparent" speed="1" autoplay>
        </dotlottie-player>
    </div>

    <!-- Logo Mini Setelah Splash -->
    <dotlottie-player id="lottieLogo" src="https://lottie.host/68f297ab-61ce-477d-94c6-31a31666d208/fXToysjn9c.lottie"
        background="transparent" speed="1" loop autoplay>
    </dotlottie-player>

    <!-- Konten utama -->
    <div id="mainContent" style="display: none;">
        <!-- Hero Section -->
        <section class="hero-section position-relative overflow-hidden">
            <!-- Animated Gradient Background -->
            <div class="hero-bg position-absolute w-100 h-100"></div>

            <!-- Moving Geometric Shapes -->
            <div class="geometric-shapes position-absolute w-100 h-100">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
                <div class="shape shape-5"></div>
                <div class="shape shape-6"></div>
            </div>

            <!-- Particle System -->
            <div class="particles position-absolute w-100 h-100">
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
                <div class="particle particle-4"></div>
                <div class="particle particle-5"></div>
                <div class="particle particle-6"></div>
                <div class="particle particle-7"></div>
                <div class="particle particle-8"></div>
            </div>

            <!-- Floating Elements -->
            <div class="floating-elements position-absolute w-100 h-100">
                <div class="float-element float-1">🌱</div>
                <div class="float-element float-2">🌾</div>
                <div class="float-element float-3">💧</div>
                <div class="float-element float-4">🚜</div>
                <div class="float-element float-5">🌿</div>
                <div class="float-element float-6">🍃</div>
                <div class="float-element float-7">🌻</div>
            </div>

            <div class="container position-relative z-3">
                <div class="row min-vh-100 align-items-center justify-content-center">
                    <div class="col-lg-10 text-center">
                        <!-- Hero Badge -->
                        <div class="hero-badge mb-4" data-aos="fade-up">
                            <span class="badge-text">
                                <i class="fas fa-leaf me-2"></i>
                                Selamat Datang di Website Pertanian Desa Sabdodadi Bantul
                            </span>
                        </div>

                        <!-- Main Title -->
                        <h1 class="hero-title mb-3" data-aos="fade-up" data-aos-delay="200">
                            <span class="title-primary">TANDUR</span>
                        </h1>

                        <!-- Subtitle -->
                        <p class="hero-subtitle mb-2" data-aos="fade-up" data-aos-delay="400">
                            Tata Lahan dan Data Urun Rancang Sabdodadi
                        </p>

                        <!-- Description -->
                        <p class="hero-description mb-5" data-aos="fade-up" data-aos-delay="600">
                            Sistem informasi geografis modern untuk membantu petani dalam mengelola lahan secara efisien dan
                            berkelanjutan
                        </p>

                        <!-- CTA Buttons -->
                        <div class="hero-cta" data-aos="fade-up" data-aos-delay="800">
                            <a href="{{ route('login') }}" class="btn btn-primary-custom me-3">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Masuk Dashboard
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-custom">
                                <i class="fas fa-user-plus me-2"></i>
                                Daftar Petani
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section py-5"
            style="background: url('{{ asset('dipakai/bg6.gif') }}') no-repeat center center / cover;">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h2 class="section-title text-white fw-bold px-4 py-2 rounded-3 shadow-lg d-inline-block"
                            data-aos="fade-up"
                            style="background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(4px); text-shadow: 2px 2px 6px rgba(0,0,0,0.6);">
                            📊 Data Statistik Terkini
                        </h2>

                        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
                            Informasi real-time tentang aktivitas pertanian di Sabdodadi
                        </p>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Jenis Tanaman -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-card stat-plants">
                            <div class="stat-icon">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number">{{ $jumlahTanaman }}</h3>
                                <h6 class="stat-title">Fasilitas dan Detail Tanaman</h6>
                                <p class="stat-desc">Fasilitas dan Detail Tanaman</p>
                            </div>
                            <div class="stat-decoration">🌱</div>
                        </div>
                    </div>

                    <!-- Perairan -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-card stat-water">
                            <div class="stat-icon">
                                <i class="fas fa-tint"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number">{{ $jumlahPerairan }}</h3>
                                <h6 class="stat-title">Perairan</h6>
                                <p class="stat-desc">Jalur perairan aktif</p>
                            </div>
                            <div class="stat-decoration">💧</div>
                        </div>
                    </div>

                    <!-- Lahan Pertanian -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-card stat-land">
                            <div class="stat-icon">
                                <i class="fas fa-map"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number">{{ $jumlahLahan }}</h3>
                                <h6 class="stat-title">Lahan Pertanian</h6>
                                <p class="stat-desc">Area terpetakan</p>
                            </div>
                            <div class="stat-decoration">🌾</div>
                        </div>
                    </div>

                    <!-- Petani Terdaftar -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="stat-card stat-farmers">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number">{{ $petaniTerdaftar }}</h3>
                                <h6 class="stat-title">Petani Terdaftar</h6>
                                <p class="stat-desc">Pengguna aktif sistem</p>
                            </div>
                            <div class="stat-decoration">👨‍🌾</div>
                        </div>
                    </div>

                    <!-- Jumlah RT -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="stat-card stat-rt">
                            <div class="stat-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number">{{ $jumlahRT }}</h3>
                                <h6 class="stat-title">Jumlah RT</h6>
                                <p class="stat-desc">Wilayah RT terdaftar</p>
                            </div>
                            <div class="stat-decoration">📍</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h2 class="section-title" data-aos="fade-up">
                            Fitur Unggulan
                        </h2>
                        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
                            Solusi teknologi terdepan untuk pertanian modern
                        </p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-card">
                            <div class="feature-icon feature-plants">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <div class="feature-content">
                                <h5 class="feature-title">Manajemen Tanaman</h5>
                                <p class="feature-desc">Catat dan kelola jenis tanaman, jadwal tanam, dan pemeliharaan
                                    dengan sistem yang terintegrasi.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-card">
                            <div class="feature-icon feature-water">
                                <i class="fas fa-tint"></i>
                            </div>
                            <div class="feature-content">
                                <h5 class="feature-title">Sistem Perairan</h5>
                                <p class="feature-desc">Kelola irigasi dan pemantauan ketersediaan air secara real-time
                                    untuk optimalisasi pengairan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-card">
                            <div class="feature-icon feature-map">
                                <i class="fas fa-map"></i>
                            </div>
                            <div class="feature-content">
                                <h5 class="feature-title">Pemetaan Lahan</h5>
                                <p class="feature-desc">Petakan area pertanian dengan teknologi GIS dan lakukan analisis
                                    spasial yang mendalam.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer-section py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="footer-brand">
                            <h6 class="mb-1">
                                <i class="fas fa-leaf me-2"></i>
                                TANDUR - Sabdodadi
                            </h6>
                            <p class="mb-0 text-muted">
                                Sistem Informasi Geografis Pertanian {{ date('Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="footer-social">
                            <p class="mb-0 text-muted small">
                                <i class="fas fa-calendar me-2"></i>
                                Sejak {{ date('Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script type="module" src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Styles -->
    <style>
        :root {
            --primary-green: #2E7D32;
            --secondary-green: #4CAF50;
            --accent-green: #66BB6A;
            --light-green: #E8F5E8;
            --dark-green: #1B5E20;
            --water-blue: #1976D2;
            --light-blue: #E3F2FD;
            --golden-yellow: #F57C00;
            --light-yellow: #FFF8E1;
            --neutral-gray: #455A64;
            --light-gray: #F5F7FA;
            --white: #FFFFFF;
            --gradient-primary: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
            --gradient-secondary: linear-gradient(135deg, #E8F5E8 0%, #F1F8E9 100%);
            --shadow-soft: 0 4px 20px rgba(46, 125, 50, 0.1);
            --shadow-medium: 0 8px 30px rgba(46, 125, 50, 0.15);
            --shadow-strong: 0 12px 40px rgba(46, 125, 50, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--neutral-gray);
            background-color: var(--light-gray);
        }

        /* Splash Screen */
        #splashOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(135deg, #E8F5E8 0%, #F1F8E9 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #splashOverlay.hidden {
            opacity: 0;
            visibility: hidden;
            transform: scale(1.1);
        }

        #lottieLogo {
            position: fixed;
            bottom: 2rem;
            left: 2rem;
            width: 60px;
            height: 60px;
            z-index: 9999;
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 50%;
            box-shadow: var(--shadow-soft);
        }

        #lottieLogo.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero-bg {
            background: linear-gradient(270deg,
                    rgba(232, 245, 232, 0.95) 0%,
                    rgba(241, 248, 233, 0.9) 25%,
                    rgba(200, 230, 201, 0.95) 50%,
                    rgba(220, 237, 200, 0.9) 75%,
                    rgba(232, 245, 232, 0.95) 100%);
            background-size: 400% 400%;
            animation: gradientShift 12s ease-in-out infinite;
            z-index: 1;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        /* Moving Geometric Shapes */
        .geometric-shapes {
            z-index: 2;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: moveShape 20s linear infinite;
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            background: var(--primary-green);
            top: 10%;
            left: -50px;
            animation-duration: 25s;
        }

        .shape-2 {
            width: 60px;
            height: 60px;
            background: var(--water-blue);
            top: 30%;
            left: -30px;
            animation-duration: 30s;
            animation-delay: -5s;
        }

        .shape-3 {
            width: 80px;
            height: 80px;
            background: var(--golden-yellow);
            top: 60%;
            left: -40px;
            animation-duration: 35s;
            animation-delay: -10s;
        }

        .shape-4 {
            width: 120px;
            height: 120px;
            background: var(--accent-green);
            top: 80%;
            left: -60px;
            animation-duration: 28s;
            animation-delay: -15s;
        }

        .shape-5 {
            width: 70px;
            height: 70px;
            background: var(--secondary-green);
            top: 20%;
            left: -35px;
            animation-duration: 32s;
            animation-delay: -8s;
        }

        .shape-6 {
            width: 90px;
            height: 90px;
            background: var(--primary-green);
            top: 45%;
            left: -45px;
            animation-duration: 38s;
            animation-delay: -12s;
        }

        @keyframes moveShape {
            0% {
                transform: translateX(0) translateY(0) rotate(0deg);
            }

            25% {
                transform: translateX(25vw) translateY(-20px) rotate(90deg);
            }

            50% {
                transform: translateX(50vw) translateY(20px) rotate(180deg);
            }

            75% {
                transform: translateX(75vw) translateY(-10px) rotate(270deg);
            }

            100% {
                transform: translateX(100vw) translateY(0) rotate(360deg);
            }
        }

        /* Particle System */
        .particles {
            z-index: 2;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--primary-green);
            border-radius: 50%;
            opacity: 0.6;
            animation: floatParticle 15s ease-in-out infinite;
        }

        .particle-1 {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .particle-2 {
            top: 40%;
            left: 20%;
            animation-delay: 2s;
        }

        .particle-3 {
            top: 60%;
            left: 15%;
            animation-delay: 4s;
        }

        .particle-4 {
            top: 30%;
            left: 80%;
            animation-delay: 1s;
        }

        .particle-5 {
            top: 70%;
            left: 85%;
            animation-delay: 3s;
        }

        .particle-6 {
            top: 50%;
            left: 90%;
            animation-delay: 5s;
        }

        .particle-7 {
            top: 15%;
            left: 60%;
            animation-delay: 2.5s;
        }

        .particle-8 {
            top: 80%;
            left: 40%;
            animation-delay: 4.5s;
        }

        @keyframes floatParticle {

            0%,
            100% {
                transform: translateY(0px) translateX(0px) scale(1);
                opacity: 0.6;
            }

            25% {
                transform: translateY(-40px) translateX(20px) scale(1.2);
                opacity: 0.8;
            }

            50% {
                transform: translateY(-20px) translateX(-15px) scale(0.8);
                opacity: 0.4;
            }

            75% {
                transform: translateY(-60px) translateX(30px) scale(1.1);
                opacity: 0.7;
            }
        }

        .floating-elements {
            z-index: 2;
            pointer-events: none;
        }

        .float-element {
            position: absolute;
            font-size: 2rem;
            opacity: 0.7;
            animation: floatComplex 12s ease-in-out infinite;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }

        .float-1 {
            top: 15%;
            left: 10%;
            animation-delay: 0s;
            animation-duration: 14s;
        }

        .float-2 {
            top: 25%;
            right: 15%;
            animation-delay: 2s;
            animation-duration: 16s;
        }

        .float-3 {
            top: 60%;
            left: 8%;
            animation-delay: 4s;
            animation-duration: 18s;
        }

        .float-4 {
            bottom: 20%;
            right: 10%;
            animation-delay: 1s;
            animation-duration: 15s;
        }

        .float-5 {
            top: 45%;
            left: 85%;
            animation-delay: 3s;
            animation-duration: 13s;
        }

        .float-6 {
            top: 35%;
            left: 50%;
            animation-delay: 5s;
            animation-duration: 17s;
        }

        .float-7 {
            bottom: 40%;
            left: 30%;
            animation-delay: 2.5s;
            animation-duration: 19s;
        }

        @keyframes floatComplex {

            0%,
            100% {
                transform: translateY(0px) translateX(0px) rotate(0deg) scale(1);
                opacity: 0.7;
            }

            25% {
                transform: translateY(-30px) translateX(15px) rotate(5deg) scale(1.1);
                opacity: 0.9;
            }

            50% {
                transform: translateY(-10px) translateX(-20px) rotate(-3deg) scale(0.9);
                opacity: 0.5;
            }

            75% {
                transform: translateY(-40px) translateX(25px) rotate(8deg) scale(1.05);
                opacity: 0.8;
            }
        }
        }

        .hero-badge {
            display: inline-block;
            margin-bottom: 2rem;
        }

        .badge-text {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: var(--shadow-soft);
            display: inline-block;
            letter-spacing: 0.5px;
        }

        .hero-title {
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 800;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .title-primary {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 4px 20px rgba(46, 125, 50, 0.3);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--primary-green);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .hero-description {
            font-size: 1.2rem;
            color: var(--neutral-gray);
            max-width: 600px;
            margin: 0 auto 3rem;
            line-height: 1.7;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary-custom {
            background: var(--gradient-primary);
            border: none;
            color: var(--white);
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-medium);
            letter-spacing: 0.5px;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-strong);
            color: var(--white);
        }

        .btn-outline-custom {
            background: transparent;
            border: 2px solid var(--primary-green);
            color: var(--primary-green);
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.5px;
        }

        .btn-outline-custom:hover {
            background: var(--primary-green);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
        }

        /* Sections */
        .stats-section {
            background: var(--white);
            position: relative;
        }

        .features-section {
            background: var(--gradient-secondary);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 1rem;
            letter-spacing: -0.01em;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--neutral-gray);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Stat Cards */
        .stat-card {
            background: var(--white);
            padding: 2.5rem 2rem;
            border-radius: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(46, 125, 50, 0.08);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-strong);
        }

        .stat-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: var(--white);
        }

        .stat-plants .stat-icon {
            background: var(--gradient-primary);
        }

        .stat-water .stat-icon {
            background: linear-gradient(135deg, #1976D2, #42A5F5);
        }

        .stat-land .stat-icon {
            background: linear-gradient(135deg, #F57C00, #FFB74D);
        }

        .stat-farmers .stat-icon {
            background: linear-gradient(135deg, #7B1FA2, #BA68C8);
        }

        .stat-rt .stat-icon {
            background: linear-gradient(135deg, #D32F2F, #EF5350);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-green);
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .stat-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--neutral-gray);
            margin-bottom: 0.5rem;
        }

        .stat-desc {
            color: var(--neutral-gray);
            opacity: 0.8;
            font-size: 0.95rem;
            margin: 0;
        }

        .stat-decoration {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            opacity: 0.2;
        }

        /* Feature Cards */
        .feature-card {
            background: var(--white);
            padding: 3rem 2rem;
            border-radius: 20px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(46, 125, 50, 0.08);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-strong);
        }

        .feature-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2.5rem;
            color: var(--white);
        }

        .feature-plants {
            background: var(--gradient-primary);
        }

        .feature-water {
            background: linear-gradient(135deg, #1976D2, #42A5F5);
        }

        .feature-map {
            background: linear-gradient(135deg, #F57C00, #FFB74D);
        }

        .feature-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-green);
            margin-bottom: 1rem;
        }

        .feature-desc {
            color: var(--neutral-gray);
            line-height: 1.7;
            margin: 0;
        }

        /* Footer */
        .footer-section {
            background: var(--primary-green);
            color: var(--white);
        }

        .footer-brand h6 {
            color: var(--white);
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .hero-cta {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary-custom,
            .btn-outline-custom {
                width: 100%;
                max-width: 280px;
                justify-content: center;
            }

            .section-title {
                font-size: 2rem;
            }

            .stat-card,
            .feature-card {
                padding: 2rem 1.5rem;
            }
        }

        /* AOS Custom */
        [data-aos] {
            pointer-events: none;
        }

        [data-aos].aos-animate {
            pointer-events: auto;
        }
    </style>

    <!-- Animation Script -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const splash = document.getElementById('splashOverlay');
            const logo = document.getElementById('lottieLogo');
            const content = document.getElementById('mainContent');

            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 100
            });

            // Splash screen transition
            setTimeout(() => {
                splash.classList.add('hidden');
                logo.classList.add('visible');
                content.style.display = 'block';
            }, 2500);

            // Counter animation
            const animateCounters = () => {
                const counters = document.querySelectorAll('.stat-number');
                counters.forEach(counter => {
                    const target = parseInt(counter.textContent);
                    let current = 0;
                    const increment = target / 50;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        counter.textContent = Math.floor(current);
                    }, 30);
                });
            };

            // Trigger counter animation when stats section is in view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        observer.unobserve(entry.target);
                    }
                });
            });

            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                observer.observe(statsSection);
            }
        });
    </script>

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection
