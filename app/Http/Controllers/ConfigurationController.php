<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ConfigurationController extends Controller
{
    public function index()
    {
        $configurations = Configuration::all(); // Mendapatkan semua maps
    
        $data = [
            'title' => 'Configurations',
            'configurations' => $configurations
        ];

        return view('configuration.index', compact('configurations'), $data);
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add New Maps',
        ];

        return view('configuration.form', $data);
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
            Configuration::create($data);
            Alert::success('Sukses', 'Data berhasil ditambahkan.');
            return redirect()->route('configuration.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->route('configuration.create');
        }
    }

    public function edit(int $id)
    {
        $configuration = Configuration::find($id);
        if (!$configuration) {
            return redirect()->route('configuration.index')->with("errorMessage", 'Configuration tidak dapat ditemukan');
        }

        $data = [
            'title' => 'Edit Configuration',
            'configuration' => $configuration
        ];

        return view('configuration.form', $data);
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
            $configuration = Configuration::findOrFail($id);
            $configuration->update($data);
            Alert::success('Sukses', 'Data berhasil diperbarui.');
            return redirect()->route('configuration.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->route('configuration.edit', $id);
        }
    }

    public function show(string $id)
    {
        $configuration = Configuration::find($id);
        $data = [
            "title" => "Configuration Detail",
            "configuration" => $configuration
        ];
        return view('configuration.detail', $data);
    }


    public function destroy(string $id)
    {
        try {
            $configuration = Configuration::findOrFail($id);
            $configuration->delete();

            return redirect()->route('configuration.index')->with("successMessage", "Data berhasil dihapus!");
        } catch (\Throwable $th) {
            return redirect()->route('configuration.index')->with("errorMessage", $th->getMessage());
        }
    }
}
