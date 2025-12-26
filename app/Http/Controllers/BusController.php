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
            ->with('driverDetail')
            ->get();
        
        $busInfos = \App\Models\BusInfo::all();
        $routes = \App\Models\Route::all();
        
        return view('admin.bus-create', compact('approvedDrivers', 'busInfos', 'routes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bus_info_id' => 'required|exists:bus_infos,id',
            'route' => 'required|integer|exists:routes,id',
            'driver_id' => 'nullable|exists:users,id',
        ]);

        // Get the selected bus info
        $busInfo = \App\Models\BusInfo::findOrFail($validated['bus_info_id']);

        Bus::create([
            'busID' => $busInfo->id,
            'route' => $validated['route'],
            'passengerCapacity' => $busInfo->passengerCapacity,
        ]);

        // If a driver is assigned, update the driver's busID
        if ($request->driver_id) {
            \App\Models\User::where('id', $request->driver_id)
                ->update(['busID' => $busInfo->id]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Bus Assigned Successfully');
    }
}
