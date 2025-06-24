<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DashboardDataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlantingScheduleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes are loaded by the RouteServiceProvider within a group
| which is assigned the "api" middleware group. Enjoy building your API!
*/

// 🧑 Autentikasi API User
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 📊 Data untuk Statistik Dashboard
Route::get('/dashboard-data', [DashboardDataController::class, 'index']);

// 📍 Data Titik (Points)
Route::get('/points', [ApiController::class, 'points'])->name('api.points');
Route::get('/point/{id}', [ApiController::class, 'point'])->name('api.point');

// ➖ Data Garis (Polylines)
Route::get('/polylines', [ApiController::class, 'polylines'])->name('api.polylines');
Route::get('/polyline/{id}', [ApiController::class, 'polyline'])->name('api.polyline');

// ⬛ Data Area (Polygons)
Route::get('/polygons', [ApiController::class, 'polygons'])->name('api.polygons');
Route::get('/polygon/{id}', [ApiController::class, 'polygon'])->name('api.polygon');

// 🌱 Jadwal Tanam & Panen (digunakan di halaman map.blade.php)
Route::get('/plantings', [PlantingScheduleController::class, 'apiData'])->name('api.plantings');
