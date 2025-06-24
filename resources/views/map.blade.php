@extends('layout.template')

@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet Draw CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <!-- ✅ Leaflet JS (NO integrity!) -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- ✅ Leaflet Fullscreen Plugin YANG BENAR -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen@2.4.0/Control.FullScreen.css" />
    <script src="https://unpkg.com/leaflet.fullscreen@2.4.0/Control.FullScreen.js"></script>

    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);
        }
    </style>
    <style>
        .planting-section {
            background-image: url("{{ asset('dipakai/bg2.gif') }}");
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .planting-section table {
            background-color: rgba(100, 238, 172, 0.9);
            /* Supaya tabel tetap kebaca */
            border-radius: 10px;
            overflow: hidden;
        }

        .table td,
        .table th {
            background-color: rgba(255, 255, 255, 0.6) !important;
        }
    </style>
    <style>
        .judul-tanam-standout {
            background: rgba(255, 255, 255, 0.7);
            /* latar semi transparan */
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            font-weight: 800;
            color: #2d3e2f;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (isset($notifications) && count($notifications))
        <div class="container mt-4">
            <div class="alert alert-warning shadow-sm">
                <ul class="mb-0">
                    @foreach ($notifications as $note)
                        <li>{!! $note !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div id="map"></div>

    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-success text-white d-flex align-items-center"
                style="background: linear-gradient(135deg, #a8e063, #56ab2f);">
                <i class="bi bi-calendar-week-fill me-2 fs-5"></i>
                <h5 class="mb-0">Kalender Tanam</h5>
            </div>
            <div class="card-body bg-light">
                <!-- Form input -->
                <form action="{{ route('planting.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <input type="text" name="plant_name" class="form-control shadow-sm border-0 rounded-3"
                                placeholder="🌱 Nama Tanaman" required>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="planting_date" class="form-control shadow-sm border-0 rounded-3"
                                required>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="harvest_date" class="form-control shadow-sm border-0 rounded-3">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success w-100 shadow-sm rounded-3" type="submit">
                                + Tambah
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Jadwal Tanam dan Panen -->
                <div class="container mt-4 planting-section">
                    <h4 class="fw-bold mb-3 judul-tanam-standout">📅 Jadwal Tanam dan Panen</h4>
                    <table class="table table-striped shadow-sm rounded-3">
                        <thead class="table-success">
                            <tr>
                                <th>Tanaman</th>
                                <th>Tanggal Tanam</th>
                                <th>Tanggal Panen</th>
                                <th>Aksi</th> <!-- tambahkan kolom ini -->

                            </tr>
                        </thead>
                        <tbody id="planting-body">
                            <!-- Data diisi lewat JavaScript -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @if (!empty($notifications))
        <div class="alert alert-warning alert-dismissible fade show m-3 shadow" role="alert">
            <ul class="mb-0">
                @foreach ($notifications as $note)
                    <li>{!! $note !!}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <!-- Legend NDVI sesuai warna citra -->
    <div id="ndvi-legend"
        style="
    position: absolute;
    bottom: 20px;
    right: 20px;
    background: rgba(255, 255, 255, 0.95);
    padding: 12px 16px;
    border-radius: 12px;
    font-size: 12px;
    color: #2d3436;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    z-index: 1000;
    font-family: 'Segoe UI', Tahoma, sans-serif;
">
        <strong style="display: block; margin-bottom: 6px;">NDVI Index</strong>

        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
            <div style="width: 16px; height: 10px; background: #ffffd9;"></div>
            <span>> 0.8 — Vegetasi sangat sehat</span>
        </div>

        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
            <div style="width: 16px; height: 10px; background: #d9ef8b;"></div>
            <span>0.6 - 0.8 — Vegetasi sehat</span>
        </div>

        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
            <div style="width: 16px; height: 10px; background: #91cf60;"></div>
            <span>0.4 - 0.6 — Vegetasi sedang</span>
        </div>

        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
            <div style="width: 16px; height: 10px; background: #1a9850;"></div>
            <span>0.2 - 0.4 — Vegetasi jarang</span>
        </div>

        <div style="display: flex; align-items: center; gap: 8px;">
            <div style="width: 16px; height: 10px; background: #006837;"></div>
            <span>
                < 0.2 — Non-vegetasi</span>
        </div>
    </div>

    <div id="weather-widget"
        style="position: absolute; bottom: 30px; left: 30px; background: linear-gradient(135deg, rgba(170, 235, 137, 0.95), rgba(255,255,255,0.85)); backdrop-filter: blur(20px); padding: 20px; z-index: 1000; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1), 0 5px 15px rgba(0,0,0,0.05); border: 1px solid rgba(255,255,255,0.2); min-width: 160px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; transition: all 0.3s ease;">
        <div id="weather-icon" style="text-align: center; margin-bottom: 12px;">
            <img src="" alt="Weather Icon"
                style="width: 60px; height: 60px; filter: drop-shadow(0 3px 6px rgba(0,0,0,0.1));" />
        </div>
        <div id="weather-temp"
            style="text-align: center; font-weight: 700; font-size: 28px; background: linear-gradient(45deg, #0984e3, #74b9ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 8px;">
            0°C
        </div>
        <div id="weather-desc"
            style="text-align: center; font-size: 14px; color: #636e72; font-weight: 500; margin-bottom: 10px;">
            Memuat...
        </div>
        <div
            style="text-align: center; font-size: 11px; color: #74b9ff; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
            Sabdodadi, Bantul
        </div>
        <div
            style="display: flex; justify-content: space-between; padding-top: 12px; border-top: 1px solid rgba(116, 185, 255, 0.2); font-size: 11px; color: #636e72;">
            <div style="text-align: center; flex: 1;">
                <div id="weather-humidity" style="font-weight: 600; color: #2d3436; margin-bottom: 2px;">--%</div>
                <div>Kelembaban</div>
            </div>
            <div style="text-align: center; flex: 1;">
                <div id="weather-wind" style="font-weight: 600; color: #2d3436; margin-bottom: 2px;">-- km/h</div>
                <div>Angin</div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="edit-form" class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="editModalLabel">Edit Jadwal Tanam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light">
                    <input type="hidden" id="edit-id">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Tanaman</label>
                        <input type="text" class="form-control" id="edit-plant-name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Tanam</label>
                        <input type="date" class="form-control" id="edit-planting-date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Panen</label>
                        <input type="date" class="form-control" id="edit-harvest-date">
                    </div>
                </div>
                <div class="modal-footer bg-white">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Create Point -->
    <div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data"
                class="modal-content" style="border: 2px solid #54C392;">
                @csrf
                <div class="modal-header" style="background-color: #15B392;">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Tambah Titik (Point)</h1>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #D2FF72;">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="name" name="name"
                            placeholder="Isi nama titik">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control border-0 shadow-sm" id="description" name="description" rows="3"
                            placeholder="Tuliskan deskripsi..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="geom_point" class="form-label fw-bold">Geometry (WKT)</label>
                        <textarea class="form-control border-0 shadow-sm" id="geom_point" name="geom_point" rows="3"
                            placeholder="POINT(…)"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Foto</label>
                        <input type="file" class="form-control border-0 shadow-sm" id="image_point" name="image"
                            onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                        <img src="" alt="Preview Gambar" id="preview-image-point" class="img-thumbnail mt-2"
                            width="100%" style="max-width: 400px; border: 2px solid #73EC8B;">
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #F8FFF0;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn"
                        style="background-color: #54C392; color: white;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Create Polyline -->
    <div class="modal fade" id="createpolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('polylines.store') }}" enctype="multipart/form-data"
                class="modal-content" style="border: 2px solid #54C392;">
                @csrf
                <div class="modal-header" style="background-color: #15B392;">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Tambah Polyline</h1>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #D2FF72;">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="name" name="name"
                            placeholder="Isi nama garis">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control border-0 shadow-sm" id="description" name="description" rows="3"
                            placeholder="Tuliskan deskripsi..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="geom_polyline" class="form-label fw-bold">Geometry (WKT)</label>
                        <textarea class="form-control border-0 shadow-sm" id="geom_polyline" name="geom_polyline" rows="3"
                            placeholder="LINESTRING(…)"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Foto</label>
                        <input type="file" class="form-control border-0 shadow-sm" id="image_polyline" name="image"
                            onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                        <img src="" alt="Preview Gambar" id="preview-image-polyline" class="img-thumbnail mt-2"
                            width="100%" style="max-width: 400px; border: 2px solid #73EC8B;">
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #F8FFF0;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn"
                        style="background-color: #54C392; color: white;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Create Polygon -->
    <div class="modal fade" id="createpolygonModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('polygons.store') }}" enctype="multipart/form-data"
                class="modal-content" style="border: 2px solid #54C392;">
                @csrf
                <div class="modal-header" style="background-color: #15B392;">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Tambah Polygon</h1>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #D2FF72;">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="name" name="name"
                            placeholder="Isi nama area">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control border-0 shadow-sm" id="description" name="description" rows="3"
                            placeholder="Tuliskan deskripsi..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="geom_polygon" class="form-label fw-bold">Geometry (WKT)</label>
                        <textarea class="form-control border-0 shadow-sm" id="geom_polygon" name="geom_polygon" rows="3"
                            placeholder="POLYGON((…))"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Foto</label>
                        <input type="file" class="form-control border-0 shadow-sm" id="image_polygon" name="image"
                            onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                        <img src="" alt="Preview Gambar" id="preview-image-polygon" class="img-thumbnail mt-2"
                            width="100%" style="max-width: 400px; border: 2px solid #73EC8B;">
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #F8FFF0;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn"
                        style="background-color: #54C392; color: white;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/@terraformer/wkt"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function loadPlantingSchedule() {
            fetch("/api/plantings")
                .then(res => res.json())
                .then(data => {
                    const tbody = $('#planting-body');
                    tbody.empty();

                    data.forEach(item => {
                        const row = `
                        <tr id="row-${item.id}">
                            <td>${item.plant_name}</td>
                            <td>${item.planting_date}</td>
                            <td>${item.harvest_date ?? '-'}</td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1"
                                    onclick="openEditModal(${item.id}, '${item.plant_name}', '${item.planting_date}', '${item.harvest_date ?? ''}')">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-danger"
                                    onclick="deletePlanting(${item.id})">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    `;
                        tbody.append(row);
                    });
                });
        }

        // ⏬ Tampilkan modal & isi data edit
        function openEditModal(id, name, planting, harvest) {
            $('#edit-id').val(id);
            $('#edit-plant-name').val(name);
            $('#edit-planting-date').val(planting);
            $('#edit-harvest-date').val(harvest);
            $('#editModal').modal('show');
        }

        // ⏬ Submit perubahan Edit
        $('#edit-form').on('submit', function(e) {
            e.preventDefault();
            const id = $('#edit-id').val();
            const data = {
                plant_name: $('#edit-plant-name').val(),
                planting_date: $('#edit-planting-date').val(),
                harvest_date: $('#edit-harvest-date').val(),
            };

            fetch(`/planting-schedule/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify(data),
                })
                .then(res => {
                    if (res.ok) {
                        $('#editModal').modal('hide');
                        loadPlantingSchedule();
                    } else {
                        alert('Gagal mengubah data!');
                    }
                });
        });

        // ⏬ Hapus data
        function deletePlanting(id) {
            if (confirm('Yakin ingin menghapus data ini?')) {
                fetch(`/planting-schedule/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                }).then(res => {
                    if (res.ok) {
                        $(`#row-${id}`).fadeOut(300, function() {
                            $(this).remove();
                        });
                    } else {
                        alert('Gagal menghapus data!');
                    }
                });
            }
        }

        loadPlantingSchedule();
    </script>


    <script>
        function loadWeather(lat, lon) {
            fetch(`/weather/${lat}/${lon}`)
                .then(response => response.json())
                .then(data => {
                    if (data.weather) {
                        const iconCode = data.weather[0].icon;
                        const iconUrl = `https://openweathermap.org/img/wn/${iconCode}@2x.png`;
                        document.querySelector('#weather-icon img').src = iconUrl;
                        document.querySelector('#weather-temp').innerText = `${data.main.temp.toFixed(1)}°C`;
                        document.querySelector('#weather-desc').innerText = data.weather[0].description;
                        document.getElementById('weather-humidity').innerText = `${data.main.humidity}%`;
                        document.getElementById('weather-wind').innerText = `${data.wind.speed} km/h`;
                    } else {
                        document.querySelector('#weather-desc').innerText = 'Gagal memuat cuaca';
                    }
                })
                .catch(err => {
                    console.error(err);
                    document.querySelector('#weather-desc').innerText = 'Error';
                });
        }

        // Lokasi: Sabdodadi
        loadWeather(-7.8910983, 110.3556490);
    </script>

    <script>
        let batasLayer;

        var map = L.map('map', {
            fullscreenControl: true,
            fullscreenControlOptions: {
                position: 'topright' // default posisi (harus ditaruh dulu)
            }
        }).setView([-7.8910983, 110.3556490], 19);


        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var satellite = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 19,
                attribution: 'Tiles © Esri'
            });

        var topographic = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            maxZoom: 17,
            attribution: '© OpenTopoMap contributors'
        });

        var baseMaps = {
            "OpenStreetMap": osm,
            "Satelit (Esri World Imagery)": satellite,
            "Topografi (OpenTopoMap)": topographic
        };

        // Load GeoJSON batas desa
        $.getJSON('/geojson/batas_sabdodadi.geojson', function(data) {
            batasLayer = L.geoJSON(data, {
                style: {
                    color: '#FF3F33',
                    weight: 3,
                    dashArray: '6, 4',
                    fillOpacity: 0.05
                },
                onEachFeature: function(feature, layer) {
                    layer.bindPopup("Batas Administrasi: " + feature.properties.name);
                    layer.bindTooltip(feature.properties.name, {
                        permanent: false,
                        direction: 'top',
                        className: 'leaflet-tooltip-own'
                    });
                }
            }).addTo(map);

            map.fitBounds(batasLayer.getBounds());
            // ✅ Inisialisasi NDVI layer (pastikan ini yang benar)
            var ndviLayer = L.tileLayer.wms(
                "https://services.sentinel-hub.com/ogc/wms/d2d5f93d-b8f8-45d3-b4c4-0fd6657027e4", {
                    layers: "NDVI", // Harus sama persis seperti nama layer kamu di dashboard Sentinel Hub
                    format: "image/png",
                    transparent: true,
                    attribution: "Sentinel Hub",
                    tileSize: 512
                });

            // ✅ Tambahkan ke control toggle
            var overlayMaps = {
                "Batas Desa Sabdodadi": batasLayer,
                "NDVI (Sabdodadi)": ndviLayer
            };

            L.control.layers(baseMaps, overlayMaps).addTo(map);

            // ✅ Tambahkan layer ke map secara default (opsional, kalau mau langsung tampil)
            ndviLayer.addTo(map);
        });
        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: true,
                marker: true,
                circlemarker: true
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;
            console.log(type);
            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);
            console.log(drawnJSONObject);
            // console.log(objectGeometry);
            if (type === 'polyline') {
                console.log("Create " + type);
                $('#geom_polyline').val(objectGeometry);
                //nanti memunculkann modal create polyline
                $('#createpolylineModal').modal('show');
            } else if (type === 'polygon' || type === 'rectangle') {
                console.log("Create " + type);
                $('#geom_polygon').val(objectGeometry);
                $('#createpolygonModal').modal('show');
            } else if (type === 'marker') {
                console.log("Create " + type);

                $('#geom_point').val(objectGeometry);
                $('#createpointModal').modal('show');
            } else {
                console.log('__undefined__');
            }
            drawnItems.addLayer(layer);
        });

        // GeoJSON Points
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('points.destroy', ':id') }}".replace(':id', feature.properties.id);
                var routeedit = "{{ route('points.edit', ':id') }}".replace(':id', feature.properties.id);

                var popupContent = `
    <div
        style="
                max-width: 270px;
                background: linear-gradient(135deg, #D2FF72, #73EC8B);
                padding: 14px 18px;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #2f3e3e;
            ">
        <h5 style="color: #15B392; font-weight: 700; margin-bottom: 8px;">
            <i class="fa-solid fa-map-pin"></i> ${feature.properties.name}
        </h5>
        <p><strong>Deskripsi:</strong><br>${feature.properties.description}</p>
        <p><strong>Dibuat oleh:</strong> ${feature.properties.user_created}</p>
        <p><strong>Tanggal dibuat:</strong><br>${feature.properties.created_at}</p>

        <div style="text-align: center; margin: 12px 0;">
            <img src="{{ asset('storage/images') }}/${feature.properties.image}" alt="Gambar Titik"
                style="width: 100%; max-width: 200px; border-radius: 10px; border: 3px solid #54C392; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
            <a href="${routeedit}" class="btn text-white"
                style="background-color: #54C392; font-weight: 600; border-radius: 10px; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 6px 10px;">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form method="POST" action="${routedelete}" onsubmit="return confirm('Yakin akan dihapus?')"
                style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn text-white"
                    style="background-color: #e74c3c; font-weight: 600; border-radius: 10px; width: 100%; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 6px 10px;">
                    <i class="fa-solid fa-trash-can"></i> Hapus
                </button>
            </form>
        </div>
    </div>
    `;

                layer.bindPopup(popupContent);
                layer.bindTooltip(feature.properties.name);

                layer.on({
                    click: function(e) {
                        layer.openPopup();
                    }
                });
            }
        });

        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        // GeoJSON Polylines
        var polyline = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('polylines.destroy', ':id') }}".replace(':id', feature.properties
                    .id);
                var routeedit = "{{ route('polylines.edit', ':id') }}".replace(':id', feature.properties.id);

                var popupContent = `
    <div
        style="
                max-width: 270px;
                background: linear-gradient(135deg, #D2FF72, #73EC8B);
                padding: 14px 18px;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #2f3e3e;
            ">
        <h5 style="color: #15B392; font-weight: 700; margin-bottom: 8px;">
            <i class="fa-solid fa-road"></i> ${feature.properties.name}
        </h5>
        <p><strong>Deskripsi:</strong><br>${feature.properties.description}</p>
        <p><strong>Panjang:</strong> ${feature.properties.length_km.toFixed(2)} km</p>
        <p><strong>Dibuat oleh:</strong> ${feature.properties.user_created}</p>
        <p><strong>Tanggal dibuat:</strong><br>${feature.properties.created_at}</p>

        <div style="text-align: center; margin: 12px 0;">
            <img src="{{ asset('storage/images') }}/${feature.properties.image}" alt="Gambar Polyline"
                style="width: 100%; max-width: 200px; border-radius: 10px; border: 3px solid #54C392; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
            <a href="${routeedit}" class="btn text-white"
                style="background-color: #54C392; font-weight: 600; border-radius: 10px; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 6px 10px;">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <form method="POST" action="${routedelete}" onsubmit="return confirm('Yakin akan dihapus?')"
                style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn text-white"
                    style="background-color: #e74c3c; font-weight: 600; border-radius: 10px; width: 100%; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 6px 10px;">
                    <i class="fa-solid fa-trash-can"></i> Hapus
                </button>
            </form>
        </div>
    </div>
    `;

                layer.bindPopup(popupContent);
                layer.bindTooltip(feature.properties.name);

                layer.on({
                    click: function(e) {
                        layer.openPopup();
                    }
                });
            }
        });

        $.getJSON("{{ route('api.polylines') }}", function(data) {
            polyline.addData(data);
            map.addLayer(polyline);
        });


        // GeoJSON Polygons
        var polygon = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('polygons.destroy', ':id') }}".replace(':id', feature.properties
                    .id);
                var routeedit = "{{ route('polygons.edit', ':id') }}".replace(':id', feature.properties.id);

                var popupContent = `
    <div
        style="
                max-width: 270px;
                background: linear-gradient(135deg, #D2FF72, #73EC8B);
                padding: 12px 16px;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #2f3e3e;
            ">
        <h5 style="color: #15B392; font-weight: 700; margin-bottom: 8px;">
            <i class="fa-solid fa-leaf"></i> ${feature.properties.name}
        </h5>
        <p style="margin-bottom: 6px;"><strong>Dibuat oleh:</strong> ${feature.properties.user_created}</p>
        <p style="margin-bottom: 6px;"><strong>Deskripsi:</strong><br>${feature.properties.description}</p>
        <p style="margin-bottom: 6px;"><strong>Luas:</strong> ${feature.properties.area_ha.toFixed(2)} ha</p>
        <p style="margin-bottom: 10px;"><strong>Tanggal dibuat:</strong><br>${feature.properties.created_at}</p>

        <div style="text-align: center; margin-bottom: 12px;">
            <img src="{{ asset('storage/images') }}/${feature.properties.image}" alt="Gambar Polygon"
                style="width: 100%; max-width: 200px; border-radius: 10px; border: 3px solid #54C392; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
            <a href="${routeedit}" class="btn text-white"
                style="
            background-color: #54C392;
            font-weight: 600;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 6px 10px;
        ">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>

            <form method="POST" action="${routedelete}" onsubmit="return confirm('Yakin akan dihapus?')"
                style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn text-white"
                    style="
                background-color: #e74c3c;
                font-weight: 600;
                border-radius: 10px;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                padding: 6px 10px;
            ">
                    <i class="fa-solid fa-trash-can"></i> Hapus
                </button>
            </form>
        </div>
    </div>
    `;
                layer.bindPopup(popupContent);
                layer.bindTooltip(feature.properties.name);

                layer.on({
                    click: function(e) {
                        layer.openPopup();
                    }
                });
            }
        });
        // Ambil data dan tambahkan ke map
        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
        });
    </script>
@endsection

</html>
