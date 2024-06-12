<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\MemberPackage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MemberPackageController extends Controller
{
    public function index()
    {
        $memberPackages = MemberPackage::all(); // Mendapatkan semua member packages
    
        $data = [
            'title' => 'Member Packages',
            'memberPackages' => $memberPackages
        ];

        return view('member-package.index', $data);
        // $data = [
        //     "subject" => "Member Package Registration",
        //     "view" => "email",
        //     "description" => "Ini adalah Registrasi Member Anda"
        // ];
        // Mail::to('parkanniko89@gmail.com')->send(new SendEmail($data));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Member Packages',
        ];

        return view('member-package.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Silakan isi nama.',
            'description.required' => 'Silakan isi deskripsi.',
            'price.required' => 'Silakan isi harga.',
            'duration_day.required' => 'Silakan isi durasi hari.',
            'is_with_trainer.required' => 'Apakah dengan trainer?',
            'duration_trainer.required' => 'Silakan isi durasi trainer.',
        ]; 
    
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'duration_day' => 'required|integer',
            'is_with_trainer' => 'required|boolean',
            'duration_trainer' => 'required|integer',
        ], $messages);
    
        try {
            MemberPackage::create($data);
            Alert::success('Sukses', 'Data berhasil ditambahkan.');
            return redirect()->route('member-package.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->route('member-package.create');
        }
    }

    public function edit(int $id)
    {
        $memberPackage = MemberPackage::find($id);
        if (!$memberPackage) {
            return redirect()->route('member-package.index')->with("errorMessage", 'Member package tidak dapat ditemukan');
        }

        $data = [
            'title' => 'Edit Member Package',
            'memberPackage' => $memberPackage
        ];

        return view('member-package.form', $data);
    }
    
    public function update(Request $request, int $id)
    {
        $messages = [
            'name.required' => 'Silakan isi nama.',
            'description.required' => 'Silakan isi deskripsi.',
            'price.required' => 'Silakan isi harga.',
            'duration_day.required' => 'Silakan isi durasi hari.',
            'is_with_trainer.required' => 'Apakah dengan trainer?',
            'duration_trainer.required' => 'Silakan isi durasi trainer.',
        ]; 
    
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'duration_day' => 'required|integer',
            'is_with_trainer' => 'required|boolean',
            'duration_trainer' => 'required|integer',
        ], $messages);
    
        try {
            $memberPackage = MemberPackage::findOrFail($id);
            $memberPackage->update($data);
            Alert::success('Sukses', 'Data berhasil diperbarui.');
            return redirect()->route('member-package.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->route('member-package.edit', $id);
        }
    }

    public function show(string $id)
    {
        $memberPackage = MemberPackage::find($id);
        $data = [
            "title" => "Member Package Detail",
            "memberPackage" => $memberPackage
        ];
        return view('member-package.detail', $data);
    }


    public function destroy(string $id)
    {
        try {
            $memberPackage = MemberPackage::findOrFail($id);
            $memberPackage->delete();

            return redirect()->route('member-package.index')->with("successMessage", "Data berhasil dihapus!");
        } catch (\Throwable $th) {
            return redirect()->route('member-package.index')->with("errorMessage", $th->getMessage());
        }
    }
}
