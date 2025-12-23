<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function create()
    {
        return view('admin.bus-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'busID' => 'required|integer|unique:buses,busID|min:101',
            'route' => 'required|string|exists:routes,routeID',
            'passengerCapacity' => 'required|integer',
        ]);

        Bus::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Assigned Successfully');
    }
}
