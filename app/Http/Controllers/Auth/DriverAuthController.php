<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('driver.dashboard');
        }

        return back()->withErrors(['username' => 'Incorrect Username or Password']);
    }

    public function showRegisterForm()
    {
        return view('auth.driver-register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255|unique:users',
            'lastname' => 'required|string|max:255',
            'age' => 'required|integer',
            'contactNumber' => 'required|string',
            'address' => 'required|string',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users',
        ]);

        $validated['name'] = $validated['firstname'] . ' ' . $validated['lastname'];
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('driver.login')->with('success', 'Registered Successfully');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('driver.login');
    }
}
