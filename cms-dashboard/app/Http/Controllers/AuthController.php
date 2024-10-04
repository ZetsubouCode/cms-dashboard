<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Function to handle user login
    public function login(Request $request)
    {
        if ($request->isMethod('get')){
            return view('sign-in');
        }

        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string|min:4',
        ]);

        // Retrieve the input login field
        $loginField = $request->input('login');
        
        // Check if the input is a valid email address or phone number or username
        if (filter_var($loginField, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } elseif (preg_match('/^[0-9]{10}$/', $loginField)) { // Adjust regex as needed for phone number format
            $field = 'phone_number'; // Ensure you have a phone_number column in the database
        } else {
            $field = 'username'; // Ensure you have a username column in the database
        }

        $credentials = [
            $field => $loginField,
            'password' => $request->input('password'),
        ];
        $remember = $request->has('remember');
        // Attempt to authenticate the user
        if (Auth::attempt($credentials,$remember)) {
            // Authentication passed, redirect to intended page or dashboard
            return redirect()->intended('dashboard'); // Change 'dashboard' to your actual route name
        }

        // If authentication fails, return back with error
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    public function reset(Request $request)
    {
        if ($request->isMethod('get')){
            return view('reset');
        }
    }

    public function logout(Request $request)
    {
        // Log the user out of the application
        Auth::logout();

        // Invalidate the current session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect to the login page or home after logout
        return redirect()->route('login');
    }
}
