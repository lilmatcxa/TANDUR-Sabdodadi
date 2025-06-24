<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolygonsController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\DashboardDataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlantingScheduleController;

// 🌤 API Cuaca
Route::get('/weather/{lat}/{lon}', [WeatherController::class, 'getWeather']);

// 📊 API Data Statistik Dashboard
Route::get('/api/dashboard-data', [DashboardDataController::class, 'index']);

// 🌱 Jadwal Tanam (halaman & simpan data dari form)
Route::post('/planting-schedule', [PlantingScheduleController::class, 'store'])->name('planting.store');
Route::get('/planting-schedule', [PlantingScheduleController::class, 'index'])->name('planting.index');
Route::put('/planting-schedule/{id}', [PlantingScheduleController::class, 'update']);
Route::delete('/planting-schedule/{id}', [PlantingScheduleController::class, 'destroy']);


// 🏠 Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// 📍 Halaman Map (satu versi saja, pakai dari salah satu controller — sesuaikan jika perlu)
Route::get('/map', [PolygonsController::class, 'index'])->middleware(['auth', 'verified'])->name('map');

// 🧑‍💼 Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 👤 Profil Pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔄 Resource CRUD untuk data spasial
Route::resource('points', PointsController::class);
Route::resource('polylines', PolylinesController::class);
Route::resource('polygons', PolygonsController::class);

// 📋 Tabel Data
Route::get('/table', [TableController::class, 'index'])->name('table');

// 🛡️ Autentikasi
require __DIR__ . '/auth.php';
