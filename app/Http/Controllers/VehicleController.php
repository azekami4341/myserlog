<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Auth::user()->vehicles;
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(StoreVehicleRequest $request)
    {
        Auth::user()->vehicles()->create($request->validated());
        return redirect()->route('vehicles.index');
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        Auth::user()->vehicle()->update($request);
        //$vehicle->update($request->all());
        return redirect()->route('vehicles.index');
    }

    public function destroy(Vehicle $vehicle)
    {
        Auth::user()->vehicle()->delete();
        //$vehicle->delete();
        return redirect()->route('vehicles.index');
    }
}