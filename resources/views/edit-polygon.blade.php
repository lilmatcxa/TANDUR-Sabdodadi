@extends('layout.template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">


    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);
        }
    </style>
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

    <div id="map"></div>

    <!-- Modal Edit Polygon -->
    <div class="modal fade" id="editpolygonModal" tabindex="-1" aria-labelledby="editPolygonLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('polygons.update', $id) }}" enctype="multipart/form-data"
                class="modal-content" style="border: 2px solid #54C392;">
                @csrf
                @method('PATCH')
                <div class="modal-header" style="background-color: #15B392;">
                    <h1 class="modal-title fs-5 text-white" id="editPolygonLabel">Edit Polygon</h1>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #D2FF72;">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="name" name="name"
                            placeholder="Isi nama polygon">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control border-0 shadow-sm" id="description" name="description" rows="3"
                            placeholder="Tuliskan deskripsi..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="geom_polygon" class="form-label fw-bold">Geometry (WKT)</label>
                        <textarea class="form-control border-0 shadow-sm" id="geom_polygon" name="geom_polygon" rows="3"
                            placeholder="POLYGON((...))"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image_polygon" class="form-label fw-bold">Foto</label>
                        <input type="file" class="form-control border-0 shadow-sm" id="image_polygon" name="image"
                            onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                        <img src="" alt="Preview Gambar" id="preview-image-polygon" class="img-thumbnail mt-2"
                            width="100%" style="max-width: 400px; border: 2px solid #73EC8B;">
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #F8FFF0;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn" style="background-color: #54C392; color: white;">Simpan</button>
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

    <script>
        let selectedPolygonLayer = null;

        var map = L.map('map').setView([-2.5632749, 500.5021656], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: false,
            edit: {
                featureGroup: drawnItems,
                edit: true,
                remove: false
            }
        });
        map.addControl(drawControl);

        // GeoJSON Polygons
        var polygon = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                drawnItems.addLayer(layer);

                layer.on('click', function() {
                    selectedPolygonLayer = layer; // ⬅️ Simpan layer yang dipilih

                    var geom = Terraformer.geojsonToWKT(layer.toGeoJSON()
                    .geometry); // ⬅️ Pakai geometry dari layer, bukan feature
                    var props = feature.properties;

                    $('#name').val(props.name);
                    $('#description').val(props.description);
                    $('#geom_polygon').val(geom);

                    if (props.image) {
                        $('#preview-image-polygon').attr('src', "/storage/images/" + props.image)
                    .show();
                    } else {
                        $('#preview-image-polygon').attr('src', "").hide();
                    }

                    var formAction = "{{ route('polygons.update', ':id') }}".replace(':id', props.id);
                    $('#form-edit-polygon').attr('action', formAction);

                    $('#editpolygonModal').modal('show');
                });

            }
        });

        // Load data via API
        $.getJSON("{{ route('api.polygon', $id) }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
            map.fitBounds(polygon.getBounds(), {
                padding: [30, 30]
            });
        });

        // Handle geometry edit
        map.on('draw:edited', function(e) {
            e.layers.eachLayer(function(layer) {
                if (layer instanceof L.Polygon) {
                    const editedGeom = Terraformer.geojsonToWKT(layer.toGeoJSON().geometry);
                    $('#geom_polygon').val(editedGeom);
                }
            });
        });


        // Tambahan WAJIB agar geometry tersimpan saat form disubmit
        $('#form-edit-polygon').on('submit', function(e) {
            if (selectedPolygonLayer) {
                const updatedGeom = Terraformer.geojsonToWKT(selectedPolygonLayer.toGeoJSON().geometry);
                $('#geom_polygon').val(updatedGeom);
            }
        });
    </script>
@endsection
