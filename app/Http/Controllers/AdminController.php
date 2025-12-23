<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::with(['bus.routeInfo'])->get();
        return view('admin.dashboard', compact('users'));
    }

    public function deleteDriver(Request $request)
    {
        $userId = $request->input('user_id');
        
        $user = User::find($userId);
        
        if ($user) {
            $user->update([
                'username' => 'This Driver is not available now',
                'password' => Hash::make('0'),
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Driver deleted successfully');
    }
}
