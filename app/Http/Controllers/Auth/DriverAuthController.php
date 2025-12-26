<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DriverDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriverAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.driver-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('driver.dashboard');
        }

        return back()->withErrors(['username' => 'Incorrect Email or Password']);
    }

    public function showRegisterForm()
    {
        return view('auth.driver-register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'age' => 'required|integer',
            'contactNumber' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users',
            'resume' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Create user account
        $user = User::create([
            'name' => $validated['firstname'] . ' ' . $validated['lastname'],
            'password' => Hash::make($validated['password']),
            'email' => $validated['email'],
            'role' => 'driver'
        ]);

        // Handle resume file upload
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        // Create driver details with the new user's ID
        DriverDetail::create([
            'user_id' => $user->id,
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'age' => $validated['age'],
            'contact_number' => $validated['contactNumber'],
            'address' => $validated['address'],
            'resume' => $resumePath,
        ]);

        return redirect()->route('driver.login')->with('success', 'Registered Successfully');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('driver.login');
    }
}
