<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DriverRejection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::with(['bus.routeInfo', 'driverDetail'])->get();
        return view('admin.dashboard', compact('users'));
    }

    public function viewDriver($id)
    {
        $user = User::with(['bus.routeInfo', 'driverDetail'])->findOrFail($id);
        return view('admin.driver-view', compact('user'));
    }

    public function approveDriver($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'approved']);
        
        return redirect()->route('admin.dashboard');
    }

    public function rejectDriver(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $user = User::findOrFail($id);
        
        // Update user status to rejected
        $user->update(['status' => 'rejected']);
        
        // Create rejection record with admin and driver info
        DriverRejection::create([
            'user_id' => $user->id,
            'admin_id' => Auth::guard('admin')->id(),
            'reason' => $request->rejection_reason,
        ]);
        
        return redirect()->route('admin.dashboard')->with('success', 'Driver rejected successfully');
    }
}
