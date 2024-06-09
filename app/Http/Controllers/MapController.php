<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MapController extends Controller
{
    public function index()
    {
        $maps = Map::all(); // Mendapatkan semua maps
    
        $data = [
            'title' => 'Maps',
            'mamps' => $maps
        ];

        return view('map.index', compact('maps'), $data);
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add New Maps',
        ];

        return view('map.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Silakan isi nama.',
            'address.required' => 'Silakan isi alamat.',
            'phone.required' => 'Silakan isi nomor ponsel.',
            'map_link.required' => 'Silakan isi link map.',
        ]; 
    
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'map_link' => 'required',
        ], $messages);
    
        try {
            Map::create($data);
            Alert::success('Sukses', 'Data berhasil ditambahkan.');
            return redirect()->route('map.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->route('map.create');
        }
    }

    public function edit(int $id)
    {
        $map = Map::find($id);
        if (!$map) {
            return redirect()->route('map.index')->with("errorMessage", 'Map tidak dapat ditemukan');
        }

        $data = [
            'title' => 'Edit Map',
            'map' => $map
        ];

        return view('map.form', $data);
    }
    
    public function update(Request $request, int $id)
    {
        $messages = [
            'name.required' => 'Silakan isi nama.',
            'address.required' => 'Silakan isi alamat.',
            'phone.required' => 'Silakan isi nomor ponsel.',
            'map_link.required' => 'Silakan isi link map.',
        ]; 
    
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'map_link' => 'required',
        ], $messages);
    
        try {
            $map = Map::findOrFail($id);
            $map->update($data);
            Alert::success('Sukses', 'Data berhasil diperbarui.');
            return redirect()->route('map.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->route('map.edit', $id);
        }
    }

    public function show(string $id)
    {
        $map = Map::find($id);
        $data = [
            "title" => "Map Detail",
            "map" => $map
        ];
        return view('map.detail', $data);
    }


    public function destroy(string $id)
    {
        try {
            $map = Map::findOrFail($id);
            $map->delete();

            return redirect()->route('map.index')->with("successMessage", "Data berhasil dihapus!");
        } catch (\Throwable $th) {
            return redirect()->route('map.index')->with("errorMessage", $th->getMessage());
        }
    }
}
