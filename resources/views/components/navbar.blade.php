<nav class="navbar navbar-expand-lg fixed-top shadow-lg navbar-pro-green">
    <!-- Partikel -->
    <div class="navbar-particles">
        <div class="particle" style="left: 10%; animation-delay: 0s; width: 6px; height: 6px;"></div>
        <div class="particle" style="left: 30%; animation-delay: 1s; width: 8px; height: 8px;"></div>
        <div class="particle" style="left: 50%; animation-delay: 2s; width: 5px; height: 5px;"></div>
        <div class="particle" style="left: 70%; animation-delay: 3s; width: 7px; height: 7px;"></div>
        <div class="particle" style="left: 90%; animation-delay: 4s; width: 6px; height: 6px;"></div>
    </div>


    <div class="container-fluid px-4">
        <a class="navbar-brand glow-text text-white fw-bold" href="#">
            <i class="fa-solid fa-earth-asia me-2"></i>{{ $title ?? 'AgriMap' }}
        </a>

        <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">

                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-house-chimney me-1"></i>Home
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('map') }}">
                        <i class="fa-solid fa-map me-1"></i>Peta
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('table') }}">
                        <i class="fa-solid fa-table me-1"></i>Tabel
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-database me-1"></i>Data
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <a class="dropdown-item" href="{{ route('api.points') }}" target="_blank">
                                    <i class="fas fa-map-marker-alt me-2 text-danger"></i>Points
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('api.polylines') }}" target="_blank">
                                    <i class="fas fa-route me-2 text-primary"></i>Polylines
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('api.polygons') }}" target="_blank">
                                    <i class="fas fa-draw-polygon me-2 text-success"></i>Polygons
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth

                <li class="nav-item mx-2">
                    <button id="musicToggle" onclick="toggleMusic()" class="music-btn" title="Musik Latar">
                        🎵
                    </button>
                </li>

                @auth
                    <li class="nav-item mx-2">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-auth btn-logout" type="submit">
                                <i class="fa-solid fa-right-from-bracket me-1"></i>Logout
                            </button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item mx-2">
                        <a class="btn btn-auth" href="{{ route('login') }}">
                            <i class="fa-solid fa-right-to-bracket me-1"></i>Login
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>

    <audio id="bgmusic" loop>
        <source src="{{ asset('dipakai/sound1.mp3') }}" type="audio/mpeg">
    </audio>
</nav>

<style>
    /* PRO Green Navbar Styles */
    .navbar-pro-green {
        background: linear-gradient(135deg, #cdeac0, #6fa36f);
        backdrop-filter: blur(15px);
        border-bottom: 1px solid rgba(111, 163, 111, 0.2);
        position: relative;
        overflow: visible !important;
        transition: all 0.3s ease-in-out;
        z-index: 1050;
        box-shadow: 0 4px 20px rgba(111, 163, 111, 0.15);
    }

    /* Scrolled state effect */
    .navbar-pro-green.scrolled {
        background: linear-gradient(135deg, rgba(205, 234, 192, 0.95), rgba(111, 163, 111, 0.95));
        backdrop-filter: blur(25px);
        box-shadow: 0 8px 32px rgba(111, 163, 111, 0.25);
    }

    /* Brand styling */
    .navbar-brand {
        font-size: 1.5rem;
        font-weight: 800;
        color: #2d3e2f !important;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
        color: #1a5a1a !important;
    }

    .navbar-brand i {
        animation: rotate 8s linear infinite;
        filter: drop-shadow(0 0 8px rgba(111, 163, 111, 0.4));
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    /* Glow text effect */
    .glow-text {
        text-shadow: 0 0 8px rgba(111, 163, 111, 0.5),
            0 0 16px rgba(111, 163, 111, 0.3),
            0 0 24px rgba(111, 163, 111, 0.2);
    }

    /* Nav links styling */
    .navbar-pro-green .nav-link {
        color: #2d3e2f !important;
        font-weight: 600;
        padding: 0.8rem 1.2rem !important;
        border-radius: 25px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        margin: 0 0.2rem;
        overflow: hidden;
    }

    .navbar-pro-green .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .navbar-pro-green .nav-link:hover::before {
        left: 100%;
    }

    .navbar-pro-green .nav-link:hover {
        background: rgba(255, 255, 255, 0.25);
        color: #1a5a1a !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(111, 163, 111, 0.2);
    }

    .navbar-pro-green .nav-link.active {
        background: rgba(255, 255, 255, 0.3);
        color: #1a5a1a !important;
        box-shadow: 0 4px 15px rgba(111, 163, 111, 0.25);
    }

    /* Floating particles */
    .navbar-particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 90px;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        animation: floatUpDown 6s infinite ease-in-out;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.4),
            0 0 20px rgba(111, 163, 111, 0.3);
    }

    /* Animasi naik-turun dan berdenyut */
    @keyframes floatUpDown {

        0%,
        100% {
            transform: translateY(0) scale(1);
            opacity: 0.7;
        }

        50% {
            transform: translateY(-20px) scale(1.2);
            opacity: 1;
        }
    }

    /* Music button */
    .music-btn {
        background: linear-gradient(135deg, #7dbf7d, #a1d89c);
        border: none;
        color: #fff;
        font-weight: 700;
        border-radius: 25px;
        padding: 0.6rem 1.2rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(125, 191, 125, 0.3);
        position: relative;
        overflow: hidden;
    }

    .music-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transition: all 0.6s ease;
        transform: translate(-50%, -50%);
    }

    .music-btn:hover::before {
        width: 200px;
        height: 200px;
    }

    .music-btn:hover {
        transform: scale(1.1);
        background: linear-gradient(135deg, #6ca06c, #8bd38b);
        box-shadow: 0 8px 25px rgba(125, 191, 125, 0.4);
    }

    .music-btn.playing {
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            box-shadow: 0 4px 15px rgba(125, 191, 125, 0.3);
        }

        50% {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(125, 191, 125, 0.5);
        }
    }

    /* Auth buttons */
    .btn-auth {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.4);
        color: #2d3e2f !important;
        padding: 0.6rem 1.4rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        text-decoration: none;
    }

    .btn-auth:hover {
        background: rgba(255, 255, 255, 0.35);
        border-color: rgba(255, 255, 255, 0.6);
        transform: translateY(-2px);
        color: #1a5a1a !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-logout {
        background: linear-gradient(135deg, #ff6b6b, #ff4757) !important;
        border: none !important;
        color: white !important;
    }

    .btn-logout:hover {
        background: linear-gradient(135deg, #ff4d4d, #ff3333) !important;
        color: white !important;
    }

    /* Dropdown menu */
    .dropdown-menu {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 1rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        animation: slideDown 0.3s ease;
        z-index: 2000 !important;
        margin-top: 0.5rem;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        border-radius: 10px;
        transition: all 0.3s ease;
        color: #2d3e2f;
        padding: 0.8rem 1rem;
        font-weight: 500;
    }

    .dropdown-item:hover {
        background: linear-gradient(135deg, #cdeac0, #a1d89c);
        color: #1a5a1a;
        transform: translateX(5px);
    }

    /* Mobile responsive */
    @media (max-width: 991px) {
        .navbar-collapse {
            background: rgba(205, 234, 192, 0.98);
            backdrop-filter: blur(20px);
            margin-top: 1rem;
            border-radius: 15px;
            padding: 1.5rem;
            animation: slideDown 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar-pro-green .nav-link {
            margin: 0.3rem 0;
            text-align: center;
        }

        .music-btn,
        .btn-auth {
            width: 100%;
            margin: 0.5rem 0;
        }
    }
    
</style>

<script>
    const music = document.getElementById("bgmusic");
    let isPlaying = false;

    function toggleMusic() {
        if (isPlaying) {
            music.pause();
        } else {
            music.play();
        }
        isPlaying = !isPlaying;
    }
</script>
