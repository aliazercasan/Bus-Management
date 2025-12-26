<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function create()
    {
        return view('admin.route-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'routeFrom' => 'required|string',
            'routeTo' => 'required|string',
            'oras' => 'required|string',
        ]);

        Route::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Route created successfully');
    }
}
