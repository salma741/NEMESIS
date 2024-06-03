<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        // Method ini kosong, Anda bisa mengisinya jika perlu
    }

    public function create()
    {
        // Method ini kosong, Anda bisa mengisinya jika perlu
    }

    public function store(Request $request)
    {
        $messages = [
            'image.mimes' => 'Format gambar harus jpg, png, atau jpeg.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 1MB.',
            'username.required' => 'Silakan isi username.',
            'username.unique' => 'Silakan isi username yang berbeda.',
            'password.required' => 'Silakan isi password.',
            'password.min' => 'Silakan isi password minimal 2 karakter.',
            'name.required' => 'Silakan isi nama.',
            'address.required' => 'Silakan isi alamat.',
            'contact.required' => 'Silakan isi nomor ponsel.',
        ];

        $data = $request->validate([
            'image' => 'sometimes|mimes:jpg,png,jpeg|max:1024',
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users',
            'password' => 'required|min:2',
            'address' => 'required',
            'contact' => 'required',
        ], $messages);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img');
            $data['image'] = $imagePath;
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect('profile')->with("successMessage", "Data berhasil ditambahkan!");
    }

    public function show()
    {
        $user = Auth::user();
        $data = [
            "title" => "Profile",
            "user" => $user
        ];
        return view('profile.index', $data);
    }

    public function edit()
    {
        $user = Auth::user();
        $data = [
            "title" => "Edit profile",
            "user" => $user
        ];
        return view('profile.edit', $data);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $messages = [
            'image.mimes' => 'Format gambar harus jpg, png, atau jpeg.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 1MB.',
            'username.required' => 'Silakan isi username.',
            'username.unique' => 'Silakan isi username yang berbeda.',
            'name.required' => 'Silakan isi nama.',
            'address.required' => 'Silakan isi alamat.',
            'contact.required' => 'Silakan isi nomor ponsel.',
        ];

        $data = $request->validate([
            'image' => 'sometimes|mimes:jpg,png,jpeg|max:1024',
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users,username,' . $user->id,
            'address' => 'required',
            'contact' => 'required',
        ], $messages);

        try {
            if ($request->hasFile('image')) {
                if ($user->image) {
                    Storage::delete($user->image);
                }
                $imagePath = $request->file('image')->store('img');
                $data['image'] = $imagePath;
                $user->image = $data['image'];
            }

            $user->name = $data['name'];
            $user->username = $data['username'];
            $user->address = $data['address'];
            $user->contact = $data['contact'];

            $user->save();

            return redirect('profile')->with("successMessage", "Profil berhasil diedit!");
        } catch (\Throwable $th) {
            return redirect('profile')->with("errorMessage", "Terjadi kesalahan saat mengedit profil!");
        }
    }
}
