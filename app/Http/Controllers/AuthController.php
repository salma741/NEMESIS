<?php

namespace App\Http\Controllers;

use Str;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;

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

    public function forgot_password(){
        return view('auth.forgot-password');
    }

    public function forgot_password_act(Request $request){
        $message = [
            'email.required' => 'Email tidak terdaftar di database',
        ];
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], $message);

        $data = [
            'email' => $request->email,
        ];

        $token = Str::random(68);

    // Simpan atau update token berdasarkan email
        PasswordResetToken::updateOrCreate(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );
        Mail::to($request->email)->send(new PasswordResetMail($token));


        return redirect()->route('forgot-password')->with('success', 'Kami telah mengirimkan link reset password ke Email');
    }
    public function validasi_forgot_password_act(Request $request,){
        $message = [
            'password.required' => 'Password minimal 3 karakter',
        ];
        $request->validate([
            'password' => 'required|min:3',
        ], $message);
        $token = PasswordResetToken::where('token', $request->token)->first();
        if (!$token){
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }
        $user = User::where('email', $token->email)->first();

        if (!$user){
            return redirect()->route('login')->with('failed', 'Email tidak terdaftar di database');
        }
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        $token->delete();
        return redirect()->route('login')->with('success', 'Password berhasil di reset');
    }
    
    public function validasi_forgot_password(Request $request, $token){
        $token = PasswordResetToken::where('token', $token)->first();
        if (!$token){
            return redirect()->route('forgot-password')->with('failed', 'Token tidak valid');
        }
        return view('auth.validasi-token', compact('token'));
    }

}
