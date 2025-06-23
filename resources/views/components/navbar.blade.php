<nav class="navbar navbar-expand-lg shadow-sm" style="background: linear-gradient(90deg, #d4fcd3, #b6ffa1);">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold text-success" href="#">
            <i class="fa-solid fa-earth-asia me-2"></i>{{ $title }}
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">

                <li class="nav-item mx-2">
                    <a class="nav-link text-dark fw-medium" href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-house-chimney me-1"></i>Home
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link text-dark fw-medium" href="{{ route('map') }}">
                        <i class="fa-solid fa-map me-1"></i>Peta
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link text-dark fw-medium" href="{{ route('table') }}">
                        <i class="fa-solid fa-table me-1"></i>Tabel
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle text-dark fw-medium" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
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

                @auth
                    <li class="nav-item mx-2">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn nav-link text-danger fw-medium" type="submit">
                                <i class="fa-solid fa-right-from-bracket me-1"></i>Logout
                            </button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item mx-2">
                        <a class="nav-link text-primary fw-medium" href="{{ route('login') }}">
                            <i class="fa-solid fa-right-to-bracket me-1"></i>Login
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
