<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PolygonsModel;
use App\Models\PointsModel;
use App\Models\PolylinesModel;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Beranda';

        $jumlahRT = 7;
        $jumlahLahan = PolygonsModel::count();
        $petaniTerdaftar = User::count();
        $jumlahTanaman = PointsModel::distinct('name')->count('name');
        $jumlahPerairan = PolylinesModel::count();

        return view('home', compact(
            'title',
            'jumlahRT',
            'jumlahLahan',
            'petaniTerdaftar',
            'jumlahTanaman',
            'jumlahPerairan'
        ));
    }
}
