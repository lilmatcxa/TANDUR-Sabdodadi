<?php

namespace App\Http\Controllers;

use App\Models\PolylinesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PolylinesController extends Controller
{
    protected $polylines;

    public function __construct()
    {
        $this->polylines = new PolylinesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Map'
        ];
        return view('map', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:polylines,name',
            'description' => 'required',
            'geom_polyline' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $imageDirectory = public_path('storage/images');
        if (!File::exists($imageDirectory)) {
            File::makeDirectory($imageDirectory, 0777, true);
        }

        $name_image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move($imageDirectory, $name_image);
        }

        // Simpan dengan konversi WKT ke GEOMETRY
        DB::table('polylines')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'geom' => DB::raw("ST_GeomFromText('{$request->geom_polyline}', 4326)"),
            'image' => $name_image,
            'user_id' => auth()->user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('map')->with('success', 'Polyline has been added');
    }

    public function getPolyline($id)
    {
        $polyline = $this->polylines->find($id);
        return response()->json($polyline);
    }

    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Polyline',
            'id' => $id,
        ];

        return view('edit-polyline', $data);
    }

    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'name' => 'required|string|unique:polylines,name,' . $id,
            'description' => 'nullable|string',
            'geom_polyline' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        // Cari polyline berdasarkan ID
        $polyline = $this->polylines->find($id);
        if (!$polyline) {
            return redirect()->route('map')->with('error', 'Polyline not found');
        }

        $oldImage = $polyline->image;
        $imageName = $oldImage;

        // Proses gambar baru jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move(public_path('storage/images'), $imageName);

            // Hapus gambar lama jika ada
            if ($oldImage && file_exists(public_path('storage/images/' . $oldImage))) {
                unlink(public_path('storage/images/' . $oldImage));
            }
        }

        // Update data ke database
        DB::table('polylines')->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'geom' => DB::raw("ST_GeomFromText('{$request->geom_polyline}', 4326)"),
            'image' => $imageName,
            'updated_at' => now(),
        ]);

        return redirect()->route('map')->with('success', 'Polyline updated successfully');
    }

    public function destroy(string $id)
    {
        $polyline = $this->polylines->find($id);
        $imagefile = $polyline ? $polyline->image : null;

        if (!$this->polylines->destroy($id)) {
            return redirect()->route('map')->with('error', 'Polyline failed to delete');
        }

        if ($imagefile && file_exists(public_path('storage/images/' . $imagefile))) {
            unlink(public_path('storage/images/' . $imagefile));
        }

        return redirect()->route('map')->with('success', 'Polyline has been deleted');
    }
}
