<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;

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
        Gate::authorize('view', $vehicle);
        $vehicle->load(['fuelLogs' => function ($query) {
        $query->orderBy('odometer', 'desc');
        }]);

        $overallFuelEfficiency = $vehicle->calculateOverallFuelEfficiency();
        $latestFuelEfficiency = $vehicle->calculateLatestFuelEfficiency();

        return view('vehicles.show', compact('vehicle', 'overallFuelEfficiency', 'latestFuelEfficiency'));
    }

    public function edit(Vehicle $vehicle)
    {
        Gate::authorize('update', $vehicle);
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        Gate::authorize('view', $vehicle);
        $vehicle->update($request->validated());
        return redirect()->route('vehicles.show', $vehicle)->with('success', 'Vehicle data has been updated!');
    }

    public function destroy(Vehicle $vehicle)
    {
        Gate::authorize('delete', $vehicle);        
        $vehicle->delete();
        return redirect()->route('vehicles.index');
    }
}