<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah RT (fix manual)
        $jumlahRT = 7;

        // Hitung jumlah polygon (lahan pertanian)
        $jumlahLahan = DB::table('polygons')->count();

        // Hitung jumlah admin/user (petani terdaftar)
        $petaniTerdaftar = User::count();

        // Hitung jumlah tanaman unik dari tabel points
        $jumlahTanaman = DB::table('points')->distinct('name')->count('name');

        // Hitung jumlah perairan dari tabel polylines
        $jumlahPerairan = DB::table('polylines')->count();

        return view('dashboard', compact(
            'jumlahRT',
            'jumlahLahan',
            'petaniTerdaftar',
            'jumlahTanaman',
            'jumlahPerairan'
        ));

         // Luas Lahan per RT
        $lahanPerRT = DB::table('polygons')
            ->join('users', 'polygons.user_id', '=', 'users.id')
            ->select('users.rt', DB::raw('SUM(polygons.area_ha) as total'))
            ->groupBy('users.rt')
            ->get();

    }

    public function getDashboardData()
{
    try {
        return response()->json([
            'petaniPerRT' => DB::table('users')
                ->select('rt', DB::raw('COUNT(*) as total'))
                ->groupBy('rt')
                ->get(),

            'lahanPerRT' => DB::table('polygons')
                ->select('rt', DB::raw('SUM(area_ha) as total'))
                ->groupBy('rt')
                ->get(),

            'jenisTanaman' => DB::table('points')
                ->select('name', DB::raw('COUNT(*) as total'))
                ->groupBy('name')
                ->get(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
        ], 500);
    }
}

}
