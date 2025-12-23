<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function dashboard()
    {
        $users = User::with(['bus.routeInfo'])->get();
        return view('driver.dashboard', compact('users'));
    }

    public function search(Request $request)
    {
        $searchUsername = $request->input('search_username');
        
        $users = User::where('username', 'like', "%{$searchUsername}%")->get();
        
        return view('driver.search', compact('users', 'searchUsername'));
    }

    public function showReportForm()
    {
        return view('driver.report');
    }

    public function submitReport(Request $request)
    {
        $validated = $request->validate([
            'busID' => 'required|integer',
            'totalPassenger' => 'required|integer',
        ]);

        $bus = Bus::with('routeInfo')->find($validated['busID']);

        if (!$bus) {
            return back()->with('error', 'Your Bus Id does not exist in our database! Just wait for the approval of the Admin!');
        }

        if ($validated['totalPassenger'] > $bus->passengerCapacity) {
            return back()->with('error', 'Passenger total cannot exceed passenger capacity.');
        }

        $bus->update(['passengerTotal' => $validated['totalPassenger']]);

        return view('driver.report', [
            'bus' => $bus,
            'totalPassenger' => $validated['totalPassenger']
        ]);
    }

    public function details()
    {
        return view('driver.details');
    }
}
