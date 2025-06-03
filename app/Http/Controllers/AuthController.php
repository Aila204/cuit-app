<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request): RedirectResponse 
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return redirect()-> route('login');
    }
    public function login(Request $request): RedirectResponse
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
         ])) {
            $user = User::where('email', $request->email)->first();
            Auth::login($user);
            return redirect('/');
         }
         return redirect()->back()->withErrors([
            'error' => 'Email or Password is incoret',
         ]); 
    }
        public function logout(Request $request): RedirectResponse
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('home');
        }
}

// Request $request variabel request tanda -> yang kita butuhkan
// $request->validate() validasi hasil dari inputan register untuk memasitikan tidak ada kesalahan dalam menginputan data,
// validate berbentuk array / |tipe datanya harus berbentuk string
// public function logout(Request $request): RedirectResponse (fungsinya untuk return value )