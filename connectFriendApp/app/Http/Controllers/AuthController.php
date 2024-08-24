<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        // Validate the registration data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required',
            'hobbies' => 'required|array|min:3',
            'instagram_username' => 'required',
            'mobile_number' => 'required',
        ]);

        $hobbies = implode(',', (array) $request->input(''));

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'gender' => $validatedData['gender'],
            'instagram_username' => 'https://www.instagram.com/' . $validatedData['instagram_username'],
            'fields_of_work' => $hobbies,
            'mobile_number' => $validatedData['mobile_number'],
            'register_price' => rand(25000, 50000),
        ]);

        return redirect('/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('user.index');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The email and password you entered did not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect('/login');
    }

}
