<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function create()
    {
        $approvedDrivers = \App\Models\User::where('status', 'approved')
            ->whereNull('busID')
            ->get();
        return view('admin.bus-create', compact('approvedDrivers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'busID' => 'required|integer|unique:buses,busID|min:101',
            'route' => 'required|string|exists:routes,routeID',
            'passengerCapacity' => 'required|integer',
            'driver_id' => 'nullable|exists:users,id',
        ]);

        Bus::create([
            'busID' => $validated['busID'],
            'route' => $validated['route'],
            'passengerCapacity' => $validated['passengerCapacity'],
        ]);

        // If a driver is assigned, update the driver's busID
        if ($request->driver_id) {
            \App\Models\User::where('id', $request->driver_id)
                ->update(['busID' => $validated['busID']]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Bus Assigned Successfully');
    }
}
