<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $finduser = User::where('google_id', $user->id)->first();
        if($finduser) {
            Auth::login($finduser);
            Request()->session()->regenerate();

            return redirect("/home");
        } else {
            $newUser = User::create([
                'username' => $user->name,
                'name' => $user->name,
                'email' => $user->email,
                'address' => "",  
                'contact' => "",                                  
                'google_id' => $user->id,
                'password' => Hash::make(""),
            ]);

            $newUser->save();
            auth('web')->login($newUser);
            session()->regenerate();

            return redirect('/home');
        }
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home');
    }
    
}
