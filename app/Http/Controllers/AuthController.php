<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'administrateur') {
                return redirect()->intended('/admin');
            } elseif (Auth::user()->role == 'étudiant') {
                return redirect()->intended('/etudiant');
            } elseif (Auth::user()->role == 'professeur') {
                return redirect()->intended('/professeur');
            } elseif (Auth::user()->role == 'chef de filière') {
                return redirect()->intended('/chefdefiliere');    // or any route you want to redirect to
                }
    

        // If login fails, redirect back with input and an error message
        return redirect()->back()->withInput()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }
}

    // Handle logout request
    public function logout(Request $request)
    {
       

    }

    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration request
    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to dashboard
        return redirect('/dashboard');
    }
}

