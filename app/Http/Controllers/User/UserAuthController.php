<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        if (session('user_logged_in')) {
            return redirect()->route('user.dashboard');
        }
        return view('user.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $user = User::where('email', $credentials['email'])->first();
        
        if ($user && Hash::check($credentials['password'], $user->password)) {
            session([
                'user_logged_in' => true,
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email
            ]);
            return redirect()->route('user.dashboard');
        }
        
        return back()->withErrors(['email' => 'Email ose fjalëkalimi është gabim.'])->withInput();
    }
    
    public function showRegister()
    {
        if (session('user_logged_in')) {
            return redirect()->route('user.dashboard');
        }
        return view('user.register');
    }
    
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ], [
            'name.required' => 'Emri është i detyrueshëm',
            'email.required' => 'Email është i detyrueshëm',
            'email.email' => 'Email nuk është valid',
            'email.unique' => 'Ky email është i regjistruar tashmë',
            'password.required' => 'Fjalëkalimi është i detyrueshëm',
            'password.min' => 'Fjalëkalimi duhet të ketë të paktën 8 karaktere',
            'password.confirmed' => 'Fjalëkalimet nuk përputhen'
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
        
        session([
            'user_logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email
        ]);
        
        return redirect()->route('user.dashboard');
    }
    
    public function logout()
    {
        session()->forget(['user_logged_in', 'user_id', 'user_name', 'user_email']);
        return redirect()->route('home');
    }
}