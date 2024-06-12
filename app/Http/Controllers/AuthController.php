<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function index()
    {
        $data = [
            "title" => "Sign Up"
        ];
        return view("auth.index", $data);
    }

    public function login(Request $request)
    {
        $messages = [
            'username.required' => 'Silakan isi username.',
            'password.required' => 'Silakan isi password',
            // Define more custom messages here
        ];

        $data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], $messages);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            if (auth()->user()->type == 'super admin') {
                return redirect()->route('admin/home');
            } else {
                return redirect()->route('home');
            }
        }

        // Kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'loginError' => 'Gagal login, username atau password tidak ditemukan',
        ])->withInput($request->only('username'));
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        $messages = [
            'email.required' => 'Silakan isi E-mail.',
            'name.required' => 'Silakan isi nama.',
            'username.required' => 'Silakan isi username.',
            'password.required' => 'Silakan isi password.',
            'password.min' => 'Password harus memiliki minimal 3 karakter.',
            'address.required' => 'Silakan isi alamat.',
            'contact.required' => 'Silakan isi kontak.',
        ];

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:3',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
        ], $messages);

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'contact' => $data['contact'],
            'email' => $data['email'],
            'type' => "0"
        ]);

        return redirect()->route('login');
    }
}
