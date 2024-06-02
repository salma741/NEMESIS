<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderby('title')->get();
       
        $data = [
            'title' => 'Programs',
            'programs' => $programs
        ];

        return view('program.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Program',
        ];

        return view('program.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'Silakan isi judul.',
            'description.required' => 'Silakan isi deskripsi.',
        ]; 
    
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ], $messages);
    
        try {
            $data['user_id'] = auth()->user()->id;

            Program::create($data);
            Alert::success('Sukses', 'Data berhasil ditambahkan.');
            return redirect('program');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('program');
        }
    }

    public function edit(string $id)
    {
        $program = Program::find($id);
        if(!$program){
            
            return redirect('program')->with("errorMessage", 'Program tidak dapat ditemukan');
        }
        $data = [
            'title' => 'Edit Program',
            'program' => $program
        ];

        return view('program.form', $data);
    }
    public function update(Request $request, string $id)
    {
        $messages = [
            'title.required' => 'Silakan isi judul.',
            'description.required' => 'Silakan isi deskripsi.',
        ]; 
    
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ], $messages);
    
        try {
            $data['user_id'] = auth()->user()->id;
            $program = Program::find($id);

            $program->update($data);
            Alert::success('Sukses', 'Data berhasil diperbarui.');
            return redirect('program');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('program');
        }
    }

    public function show(string $id)
    {
        $program = Program::find($id);
        $data = [
            "title" => "Program Detail",
            "program" => $program
        ];
        return view('program.detail', $data);
    }

    public function destroy(string $id)
    {
        try{
            $program = Program::find($id);
            $program->delete();

            return redirect('program')->with("successMessage", "Data berhasil dihapus!");
        } catch (\Throwable $th){
            return redirect('program')->with("errorMessage", "Data gagal ditambahkan!");
        }
    }
}
