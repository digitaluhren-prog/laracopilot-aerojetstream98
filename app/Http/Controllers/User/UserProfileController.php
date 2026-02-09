<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $user = User::findOrFail(session('user_id'));
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:255',
            'password' => 'nullable|min:8|confirmed'
        ], [
            'name.required' => 'Emri është i detyrueshëm',
            'email.required' => 'Email është i detyrueshëm',
            'email.email' => 'Email nuk është valid',
            'email.unique' => 'Ky email është i regjistruar tashmë',
            'password.min' => 'Fjalëkalimi duhet të ketë të paktën 8 karaktere',
            'password.confirmed' => 'Fjalëkalimet nuk përputhen'
        ]);
        
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->city = $validated['city'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        
        $user->save();
        
        session([
            'user_name' => $user->name,
            'user_email' => $user->email
        ]);
        
        return redirect()->route('user.dashboard')
            ->with('success', 'Profili u përditësua me sukses!');
    }
}