<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Trainer::orderby('name')->get();
       
        $data = [
            'title' => 'Trainers',
            'trainers' => $trainers
        ];

        return view('trainer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Trainer',
        ];

        return view('trainer.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Silakan isi nama.',
            'description.required' => 'Silakan isi deskripsi.',
            'address.required' => 'Silakan isi alamat.',
            'phone.required' => 'Silakan isi nomor ponsel.',
        ]; 
    
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'image' => 'required|mimes:jpg,png,jpeg|max:1024',            
        ], $messages);

    
        try {
            if($request->hasFile('image')) {
                $data['image'] = $request->file("image")->store('img');
            } else {
                $data['image'] = null;
            }

            Trainer::create($data);
            Alert::success('Sukses', 'Data berhasil ditambahkan.');
            return redirect('trainer');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('trainer');
        }
    }

    public function edit(string $id)
    {
        $trainer = Trainer::find($id);
        if(!$trainer){
            
            return redirect('trainer')->with("errorMessage", 'Trainer tidak dapat ditemukan');
        }
        $data = [
            'title' => 'Edit Trainer',
            'trainer' => $trainer
        ];

        return view('trainer.form', $data);
    }
    
    public function update(Request $request, string $id)
    {
        $messages = [
            'name.required' => 'Silakan isi nama.',
            'description.required' => 'Silakan isi deskripsi.',
            'address.required' => 'Silakan isi alamat.',
            'phone.required' => 'Silakan isi nomor ponsel.',
        ]; 
    
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'image' => 'required|mimes:jpg,png,jpeg|max:1024',
        ], $messages);
    
        try {
            if($request->hasFile('image')) {
                $data['image'] = $request->file("image")->store('img');
            } else {
                $data['image'] = null;
            }
            
            $trainer = Trainer::findOrFail($id);
            $trainer->update($data);
            Alert::success('Sukses', 'Data berhasil diperbarui.');
            return redirect('trainer');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('trainer');
        }
    }

    public function show(string $id)
    {
        $trainer = Trainer::find($id);
        $data = [
            "title" => "Trainer Detail",
            "trainer" => $trainer
        ];
        return view('trainer.detail', $data);
    }

    public function destroy(string $id)
    {
        try{
            $trainer = Trainer::find($id);
            $trainer->delete();

            return redirect('trainer')->with("successMessage", "Data berhasil dihapus!");
        } catch (\Throwable $th){
            return redirect('trainer')->with("errorMessage", "Data gagal ditambahkan!");
        }
    }
    
}
