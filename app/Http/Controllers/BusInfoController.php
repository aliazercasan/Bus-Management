<?php

namespace App\Http\Controllers;

use App\Models\BusInfo;
use Illuminate\Http\Request;

class BusInfoController extends Controller
{
    public function create()
    {
        return view('admin.businfo-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'busName' => 'required|string|max:255',
            'engineNumber' => 'required|string|unique:bus_infos,engineNumber|max:255',
            'passengerCapacity' => 'required|integer|min:1',
        ]);

        BusInfo::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Bus Created Successfully');
    }
}
