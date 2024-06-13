<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // SELECT * FROM users WHERE role='user' ORDER BY name
        $users = User::orderBy('name')->get();
        $userCount = User::count(); // Mendapatkan jumlah total user

        $data = [
            "title" => "Users",
            "users" => $users,
            "userCount" => $userCount // Mengirimkan $userCount ke view
        ];
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Add User",
        ];
        return view('user.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'username.required' => 'Silakan isi username.',
            'username.unique' => 'Silakan isi username yang berbeda.',
            'password.required' => 'Silakan isi password',
            'password.min' => 'Silakan isi password minimal 2 karakter',
            'name.required' => 'Silakan isi nama.',
            'address.required' => 'Silakan isi alamat.',
            'contact.required' => 'Silakan isi nomor ponsel.',
            'role.required' => 'Silakan isi role',
            // Define more custom messages here
            ];
        $data = $request->validate([
            'name' => 'required',
            'image' => 'sometimes',
            'username' => 'required|alpha_num|unique:users',
            'password' => 'required|min:2',
            'address' => 'required',
            'contact' => 'required',
            'role' => 'required',
        ], $messages);

        $data['password'] = Hash::make($data["password"]);
        User::create($data);

        return redirect('user')->with("successMessage", "Data berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $data = [
            "title" => "User Detail",
            "user" => $user
        ];
        return view('user.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        // Protections to disallow random id
        if(!$user) {
            return redirect('user')->with("errorMessage", "User tidak ditemukan!");
        }
        $data = [
            "title" => "Edit User",
            "user" => $user
        ];
        return view('user.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'username.required' => 'Silakan isi username.',
            'username.unique' => 'Silakan isi username yang berbeda.',
            'password.min' => 'Silakan isi password minimal 2 karakter',
            'name.required' => 'Silakan isi nama.',
            'address.required' => 'Silakan isi alamat.',
            'contact.required' => 'Silakan isi nomor ponsel.',
            'role.required' => 'Silakan isi role',
            // Define more custom messages here
            ];
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_num|unique:users,username,' . $id,
            'password' => 'nullable|min:2',
            'address' => 'required',
            'contact' => 'required',
            'role' => 'required',
            'image' => 'sometimes',
        ], $messages);

        try{
            
            $user = User::find($id);
            if($request->password){
                $data['password'] = Hash::make($data["password"]);
            }else {
                $data['password'] = $user->password;
            }

            $user->update($data);
    
            return redirect('user')->with("successMessage", "Data berhasil diedit!");
        }catch (\Throwable $th){
            return redirect('user')->with("errorMessage", "Data gagal diedit!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $user = User::find($id);
            $user->delete();

            return redirect('user')->with("successMessage", "Data berhasil dihapus!");
        } catch (\Throwable $th){
            return redirect('user')->with("errorMessage", "Data gagal ditambahkan!");
        }
    }
    
}
