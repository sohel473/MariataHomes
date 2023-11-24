<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function showHomePage() {
        if (Auth::check()) {
            return redirect('/profile');
        }
        return view('home');
    }

    public function registerPage() {
        return view('auth/register');
    }

    public function register(Request $request) {
        $request->validate([
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')],
            'email' => [Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:255', 'confirmed'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email, 
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        session()->flash('success', 'You have been registered and login successfully.');

        return redirect('/create_profile');
    }

    public function loginPage() {
        return view('auth/login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Log the user in
            Auth::login($user);

            $request->session()->regenerate();

            
            session()->flash('success', 'You have been logged in successfully.');
            return redirect('/profile');

        }

        session()->flash('failure', 'The provided credentials do not match our records.');

        return back()->withInput($request->only('username'));
    }

    public function logout(Request $request) {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        session()->flash('success', 'You have been logged out successfully.');
    
        return redirect('/');
    } 
}
