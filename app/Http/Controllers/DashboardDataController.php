<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardDataController extends Controller
{
    public function index()
    {
        // Petani per RT
        $petaniPerRT = DB::table('users')
            ->select('rt', DB::raw('COUNT(*) as total'))
            ->groupBy('rt')
            ->get();

        // Lahan per RT (dari polygon)
        $lahanPerRT = DB::table('polygons')
            ->join('users', 'polygons.user_id', '=', 'users.id')
            ->select('users.rt', DB::raw('SUM(polygons.area_ha) as total'))
            ->groupBy('users.rt')
            ->get();

        // Jenis tanaman (dari points)
        $jenisTanaman = DB::table('points')
            ->select('name', DB::raw('COUNT(*) as total'))
            ->groupBy('name')
            ->get();

        return response()->json([
            'petaniPerRT' => $petaniPerRT,
            'lahanPerRT' => $lahanPerRT,
            'jenisTanaman' => $jenisTanaman,
        ]);
    }
}
