@extends('layout.template')

@section('content')
    <div class="container mt-5">
        <div class="highlighted-title mx-auto mb-5">
            <h2 class="text-center fw-bold mb-0" style="font-size: 1.75rem; color: #15B392;">
                📍 Daftar Data Pertanian Wilayah Sabdodadi, Bantul —
                <span class="text-tanaman">Jenis Tanaman</span>,
                <span class="text-perairan">Perairan</span>, dan
                <span class="text-lahan">Lahan Pertanian</span>
            </h2>
        </div>

        {{-- POINTS --}}
        <div class="card shadow-sm mb-5 border-0 rounded-4">
            <div class="card-header text-dark rounded-top-4" style="background-color: #D2FF72;">
                <h4 class="mb-0">🌱 Jenis Tanaman</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle" id="pointstable">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php $no = 1; @endphp
                        @foreach ($points as $point)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><span class="badge" style="background-color: #73EC8B;">Point</span></td>
                                <td>{{ $point->name }}</td>
                                <td>{{ $point->description }}</td>
                                <td>
                                    <img src="{{ asset('storage/images/' . $point->image) }}" class="img-thumbnail"
                                        width="120" alt="{{ $point->name }}" title="Photo of {{ $point->name }}">
                                </td>
                                <td>{{ $point->created_at }}</td>
                                <td>{{ $point->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- POLYLINES --}}
        <div class="card shadow-sm mb-5 border-0 rounded-4">
            <div class="card-header text-white rounded-top-4" style="background-color: #54C392;">
                <h4 class="mb-0">💧 Perairan</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle" id="polylinestable">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php $no = 1; @endphp
                        @foreach ($polylines as $polyline)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><span class="badge" style="background-color: #54C392;">Polyline</span></td>
                                <td>{{ $polyline->name }}</td>
                                <td>{{ $polyline->description }}</td>
                                <td>
                                    <img src="{{ asset('storage/images/' . $polyline->image) }}" class="img-thumbnail"
                                        width="120" alt="{{ $polyline->name }}" title="Photo of {{ $polyline->name }}">
                                </td>
                                <td>{{ $polyline->created_at }}</td>
                                <td>{{ $polyline->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- POLYGONS --}}
        <div class="card shadow-sm mb-5 border-0 rounded-4">
            <div class="card-header text-white rounded-top-4" style="background-color: #15B392;">
                <h4 class="mb-0">🌾 Lahan Pertanian</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle" id="polygonstable">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php $no = 1; @endphp
                        @foreach ($polygons as $polygon)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><span class="badge" style="background-color: #15B392;">Polygon</span></td>
                                <td>{{ $polygon->name }}</td>
                                <td>{{ $polygon->description }}</td>
                                <td>
                                    <img src="{{ asset('storage/images/' . $polygon->image) }}" class="img-thumbnail"
                                        width="120" alt="{{ $polygon->name }}" title="Photo of {{ $polygon->name }}">
                                </td>
                                <td>{{ $polygon->created_at }}</td>
                                <td>{{ $polygon->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
    <style>
        body {
            background: url('{{ asset('dipakai/bg.gif') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .highlighted-title {
            background-color: rgba(255, 255, 255, 0.88);
            padding: 20px 30px;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            max-width: 900px;
        }

        .text-tanaman {
            color: #54C392;
            font-weight: 700;
        }

        .text-perairan {
            color: #73EC8B;
            font-weight: 700;
        }

        .text-lahan {
            color: #15B392;
            font-weight: 700;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        }

        .card-header {
            padding: 16px 24px;
        }

        .card-header h4 {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .table th,
        .table td {
            vertical-align: middle !important;
            font-size: 14px;
        }

        .table img {
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-size: 0.75rem;
            padding: 6px 10px;
            border-radius: 12px;
            color: #fff;
        }

        .table-dark {
            background-color: #2c3e50 !important;
        }

        .table-dark th {
            color: #ecf0f1 !important;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script>
        new DataTable('#pointstable');
        new DataTable('#polylinestable');
        new DataTable('#polygonstable');
    </script>
@endsection
