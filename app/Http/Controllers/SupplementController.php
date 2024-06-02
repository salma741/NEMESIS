<?php

namespace App\Http\Controllers;

use App\Models\Supplement;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupplementController extends Controller
{
    public function index()
    {
        $supplements = Supplement::orderby('title')->get();
       
        $data = [
            'title' => 'Suplements',
            'supplements' => $supplements
        ];

        return view('supplement.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Supplement',
        ];

        return view('supplement.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'Silakan isi nama.',
            'description.required' => 'Silakan isi deskripsi.',
        ]; 
    
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|mimes:jpg,png,jpeg|max:1024',            
        ], $messages);

    
        try {
            $data['user_id'] = auth()->user()->id;
            if($request->hasFile('image')) {
                $data['image'] = $request->file("image")->store('img');
            } else {
                $data['image'] = null;
            }

            Supplement::create($data);
            Alert::success('Sukses', 'Data berhasil ditambahkan.');
            return redirect('supplement');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('supplement');
        }
    }

    public function edit(string $id)
    {
        $supplement = Supplement::find($id);
        if(!$supplement){
            
            return redirect('supplement')->with("errorMessage", 'Supplement tidak dapat ditemukan');
        }
        $data = [
            'title' => 'Edit Supplement',
            'supplement' => $supplement
        ];

        return view('supplement.form', $data);
    }
    
    public function update(Request $request, string $id)
    {
        $messages = [
            'title.required' => 'Silakan isi nama.',
            'description.required' => 'Silakan isi deskripsi.',
        ]; 
    
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|mimes:jpg,png,jpeg|max:1024',            
        ], $messages);

    
        try {
            $data['user_id'] = auth()->user()->id;
            if($request->hasFile('image')) {
                $data['image'] = $request->file("image")->store('img');
            } else {
                $data['image'] = null;
            }

            $supplement = Supplement::findOrFail($id);
            $supplement->update($data);

            Alert::success('Sukses', 'Data berhasil diperbarui.');
            return redirect('supplement');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('supplement');
        }
    }

    public function show(string $id)
    {
        $supplement = Supplement::find($id);
        $data = [
            "title" => "Supplement Detail",
            "supplement" => $supplement
        ];
        return view('supplement.detail', $data);
    }

    public function destroy(string $id)
    {
        try {
            $supplement = Supplement::findOrFail($id);
            $supplement->delete(); // menggunakan soft delete

            return redirect('supplement')->with("successMessage", "Data berhasil dihapus!");
        } catch (\Throwable $th) {
            return redirect('supplement')->with("errorMessage", "Data gagal dihapus!");
        }
    }
    
}
