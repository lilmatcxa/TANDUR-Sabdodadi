<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather($lat, $lon)
{
    try {
        $apiKey = env('OPENWEATHER_API_KEY');

        // Tambahkan pengecekan key
        if (!$apiKey) {
            return response()->json(['error' => 'API Key tidak ditemukan di .env'], 500);
        }

        $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units=metric&appid={$apiKey}";

        $response = Http::get($url);

        if (!$response->successful()) {
            return response()->json([
                'error' => 'Gagal mengambil data cuaca dari OpenWeather',
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }

        return response()->json($response->json());
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Exception terjadi',
            'message' => $e->getMessage(),
        ], 500);
    }
}

}
