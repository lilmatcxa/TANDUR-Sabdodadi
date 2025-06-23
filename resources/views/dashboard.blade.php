<x-app-layout>
    <!-- Lottie Player -->
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

    <!-- Splash Lottie (akan bergeser jadi logo mini) -->
    <dotlottie-player id="lottieLogoSplash"
        src="https://lottie.host/68f297ab-61ce-477d-94c6-31a31666d208/fXToysjn9c.lottie" background="transparent"
        speed="1" autoplay loop>
    </dotlottie-player>

    <x-slot name="header">
    <div class="relative overflow-hidden mb-6">
        <!-- Background Gradient dengan animasi -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#D2FF72]/30 via-[#73EC8B]/30 to-[#15B392]/30 animate-pulse">
        </div>

        <!-- Konten utama -->
        <div class="relative z-10 py-4 px-4 sm:py-6">
            <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg border border-[#54C392]/30 p-6">
                <h2
                    class="text-2xl sm:text-3xl font-extrabold text-[#15B392] leading-tight tracking-wide flex items-center gap-3 animate-fade-in-up">
                    <span class="text-3xl sm:text-4xl animate-bounce">🌱</span>
                    <span class="block">TANDUR - Tata Lahan dan Data Urun Rancang Sabdodadi</span>
                    <span class="text-2xl sm:text-3xl animate-pulse text-[#73EC8B]">🧑‍🌾</span>
                </h2>
                <p class="mt-2 text-sm sm:text-base text-[#54C392] italic animate-fade-in">
                    Platform kolaboratif untuk pengelolaan lahan dan pemetaan partisipatif di Kalurahan Sabdodadi.
                </p>
            </div>
        </div>
    </div>
</x-slot>

    <div id="splashOverlay"
        class="fixed inset-0 bg-white z-[9998] flex items-center justify-center transition-opacity duration-1000"
        aria-hidden="true">
    </div>
    <div id="mainContent" class="hidden opacity-0 transition-opacity duration-700">
        <div class="py-12 min-h-screen relative overflow-hidden absolute inset-0 bg-white/40 backdrop-blur-sm z-0"
            style="background-image: url('/dipakai/bg2.gif'); background-size: cover; background-repeat: no-repeat; background-position: center;">
            <!-- seluruh isi dashboard -->
            <!-- Floating Animation Elements -->
            <div class="absolute inset-0 pointer-events-none z-0">
                <div class="absolute top-10 left-10 text-2xl animate-float opacity-30">🌱</div>
                <div class="absolute top-20 right-20 text-xl animate-float-delayed opacity-25">🌾</div>
                <div class="absolute bottom-20 left-20 text-3xl animate-float-slow opacity-20">🚜</div>
                <div class="absolute bottom-10 right-10 text-2xl animate-float opacity-30">🌽</div>
                <div class="absolute top-1/2 left-1/4 text-xl animate-float-delayed opacity-20">🍃</div>
                <div class="absolute top-1/3 right-1/3 text-2xl animate-float-slow opacity-25">🌻</div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
                <!-- Welcome Card -->
                <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)" x-show="show"
                    x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 scale-90 translate-y-8"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    class="bg-white/90 backdrop-blur-sm shadow-2xl hover:shadow-3xl transform hover:-translate-y-2 transition-all duration-500 rounded-3xl p-10 mb-12 border border-green-200/50">
                    <div class="text-center mb-10">
                        <div
                            class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-green-400 to-lime-500 rounded-full mb-4 animate-pulse-slow">
                            <span class="text-3xl">🌾</span>
                        </div>
                        <h3 class="text-gray-800 text-2xl font-bold mb-2">
                            👋 Selamat Datang di AgriMap Bantul!
                        </h3>
                        <p class="text-gray-600 text-lg">
                            Platform digital terdepan untuk pemetaan dan analisis pertanian di Kabupaten Bantul.
                        </p>
                    </div>

                    <!-- Feature Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                        <div
                            class="bg-gradient-to-br from-green-50 to-lime-50 p-6 rounded-2xl border border-green-200/50 hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <div class="text-3xl mb-3">🗺️</div>
                            <h4 class="font-semibold text-green-800 mb-2">Peta Interaktif</h4>
                            <p class="text-green-600 text-sm">Jelajahi data geospasial pertanian dengan visualisasi
                                modern
                            </p>
                        </div>

                        <div
                            class="bg-gradient-to-br from-lime-50 to-yellow-50 p-6 rounded-2xl border border-lime-200/50 hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <div class="text-3xl mb-3">📊</div>
                            <h4 class="font-semibold text-lime-800 mb-2">Analisis Data</h4>
                            <p class="text-lime-600 text-sm">Dapatkan insight mendalam tentang pola pertanian regional
                            </p>
                        </div>

                        <div
                            class="bg-gradient-to-br from-yellow-50 to-orange-50 p-6 rounded-2xl border border-yellow-200/50 hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <div class="text-3xl mb-3">🌱</div>
                            <h4 class="font-semibold text-yellow-800 mb-2">Smart Farming</h4>
                            <p class="text-yellow-600 text-sm">Teknologi terkini untuk optimasi hasil pertanian</p>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="text-center">
                        <a href="{{ url('/map') }}"
                            class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-500 via-lime-500 to-yellow-400 text-white font-bold rounded-full shadow-xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500 ease-out relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 group-hover:animate-shimmer">
                            </div>
                            <span class="text-2xl mr-3 group-hover:animate-bounce">🗺️</span>
                            <span class="relative z-10">Mulai Eksplorasi Peta</span>
                            <svg class="ml-3 w-5 h-5 group-hover:translate-x-2 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">🌤️ Info Cuaca Saat Ini</h5>
                            <p class="card-text" id="weather-info">Sedang memuat data cuaca...</p>
                        </div>
                    </div>
                    <script>
                        const lat = -7.9;
                        const lon = 110.3;

                        fetch(`/weather/${lat}/${lon}`)
                            .then(res => res.json())
                            .then(data => {
                                const w = data.weather[0].description;
                                const t = data.main.temp;
                                const h = data.main.humidity;
                                const icon = data.weather[0].icon;

                                document.getElementById('weather-info').innerHTML = `
                <img src="http://openweathermap.org/img/wn/${icon}.png" alt="icon cuaca">
                <strong>Cuaca:</strong> ${w}<br>
                <strong>Suhu:</strong> ${t}°C<br>
                <strong>Kelembapan:</strong> ${h}%`;
                            })
                            .catch(() => {
                                document.getElementById('weather-info').innerHTML = 'Gagal memuat data cuaca.';
                            });
                    </script>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    @php
                        $stats = [
                            ['icon' => '🌾', 'label' => 'Lahan Pertanian', 'value' => $jumlahLahan, 'color' => 'green'],
                            [
                                'icon' => '👨‍🌾',
                                'label' => 'Petani Terdaftar',
                                'value' => $petaniTerdaftar,
                                'color' => 'lime',
                            ],
                            ['icon' => '📍', 'label' => 'Jumlah RT', 'value' => $jumlahRT, 'color' => 'yellow'],
                            [
                                'icon' => '🌱',
                                'label' => 'Jenis Tanaman',
                                'value' => $jumlahTanaman,
                                'color' => 'yellow',
                            ],
                            ['icon' => '💧', 'label' => 'Perairan', 'value' => $jumlahPerairan, 'color' => 'sky'],
                        ];
                    @endphp

                    @foreach ($stats as $i => $stat)
                        <div x-data="{ show: false }" x-init="setTimeout(() => show = true, {{ 600 + $i * 200 }})" x-show="show"
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-{{ $stat['color'] }}-100">
                            <div class="flex items-center">
                                <div class="bg-{{ $stat['color'] }}-100 p-3 rounded-full">
                                    <span class="text-2xl">{{ $stat['icon'] }}</span>
                                </div>
                                <div class="ml-4">
                                    <p class="text-2xl font-bold text-{{ $stat['color'] }}-800 animate-count-up">
                                        {{ $stat['value'] }}</p>
                                    <p class="text-{{ $stat['color'] }}-600 text-sm">{{ $stat['label'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes float-delayed {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-15px) rotate(-3deg);
            }
        }

        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(2deg);
            }
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) skewX(-12deg);
            }

            100% {
                transform: translateX(200%) skewX(-12deg);
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        @keyframes count-up {
            from {
                opacity: 0;
                transform: scale(0.5);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float-delayed 8s ease-in-out infinite;
        }

        .animate-float-slow {
            animation: float-slow 10s ease-in-out infinite;
        }

        .animate-shimmer {
            animation: shimmer 1.5s ease-in-out infinite;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.7s ease-out;
        }

        .animate-fade-in {
            animation: fade-in 1.2s ease-out;
        }

        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }

        .animate-count-up {
            animation: count-up 1s ease-out;
        }
    </style>

    <style>
        #splashOverlay {
            transition: opacity 1.2s ease-in-out;
        }

        #lottieLogoSplash {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 300px;
            height: 300px;
            transform: translate(-50%, -50%);
            z-index: 9999;
            pointer-events: none;
            transition: all 1s ease-in-out;
        }

        /* Setelah waktu splash selesai, berubah jadi logo kecil di kiri bawah */
        .logo-mini {
            bottom: 1rem !important;
            left: 1rem !important;
            top: auto !important;
            /* tambahkan ini untuk memastikan properti 'top' diabaikan */
            width: 60px !important;
            height: 60px !important;
            transform: translate(0, 0) !important;
        }
    </style>
    <script type="module">
        window.addEventListener('DOMContentLoaded', () => {
            const splash = document.getElementById('lottieLogoSplash');
            const overlay = document.getElementById('splashOverlay');
            const mainContent = document.getElementById('mainContent');

            setTimeout(() => {
                // 1. Ubah splash jadi logo mini
                splash.classList.add('logo-mini');

                setTimeout(() => {
                    // 2. Hilangkan overlay putih
                    overlay.classList.add('hide-overlay');

                    // 3. Tampilkan konten utama (fade in)
                    mainContent.classList.remove('hidden');
                    setTimeout(() => {
                        mainContent.classList.remove('opacity-0');
                    }, 50);

                }, 1000); // Tunggu animasi logo kecil selesai
            }, 2500); // Waktu splash tengah
        });
    </script>

</x-app-layout>
