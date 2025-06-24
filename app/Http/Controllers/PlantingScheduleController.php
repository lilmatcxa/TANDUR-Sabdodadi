<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantingSchedule;
use Carbon\Carbon;


class PlantingScheduleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'plant_name' => 'required|string',
            'planting_date' => 'required|date',
            'harvest_date' => 'nullable|date|after_or_equal:planting_date',
        ]);

        PlantingSchedule::create($request->all());

        return redirect()->back()->with('success', 'Jadwal tanam berhasil disimpan!');
    }

    public function index()
    {
        $plantings = PlantingSchedule::orderBy('planting_date')->get();
        $now = Carbon::now();
        $notifications = [];

        foreach ($plantings as $item) {
            // Notifikasi tanam 3 hari lagi
            if (
                $item->planting_date &&
                Carbon::parse($item->planting_date)->diffInDays($now, false) === -3
            ) {
                $notifications[] = "🌱 <strong>{$item->plant_name}</strong> akan ditanam 3 hari lagi!";
            }

            // Notifikasi panen dalam 3 hari ke depan
            if (
                $item->harvest_date &&
                Carbon::parse($item->harvest_date)->diffInDays($now, false) <= 3 &&
                Carbon::parse($item->harvest_date)->isFuture()
            ) {
                $notifications[] = "🌾 <strong>{$item->plant_name}</strong> akan dipanen dalam 3 hari!";
            }
        }

        return view('map', compact('notifications', 'plantings'));
    }

    public function apiData()
    {
        $data = \App\Models\PlantingSchedule::orderBy('planting_date')->get();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $planting = PlantingSchedule::findOrFail($id);

        $request->validate([
            'plant_name' => 'required|string|max:255',
            'planting_date' => 'required|date',
            'harvest_date' => 'nullable|date',
        ]);

        $planting->update($request->all());

        return response()->json(['message' => 'Updated']);
    }

    public function destroy($id)
    {
        $planting = PlantingSchedule::findOrFail($id);
        $planting->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
