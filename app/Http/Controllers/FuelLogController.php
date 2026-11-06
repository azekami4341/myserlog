<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFuelLogRequest;
use App\Http\Requests\UpdateFuelLogRequest;
use App\Models\Vehicle;
use App\Models\FuelLog;

class FuelLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $vehicleId = $request->query('vehicle_id');
        $vehicle = Auth::user()->vehicles()->findOrFail($vehicleId);
        Gate::authorize('create', FuelLog::class);

        return view('fuel-logs.create', compact('vehicle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFuelLogRequest $request)
    {
        Gate::authorize('create', FuelLog::class);  //policy
        $validated = $request->validated(); // input validated data
        $vehicle = Auth::user()->vehicles()->findOrFail($validated['vehicle_id']); // input only authed user with his vehicle id
        $vehicle->fuelLogs()->create($validated); //save

        return redirect()->route('vehicles.show', $vehicle)->with('success', 'Fuel log has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelLog $fuelLog)
    {
        Gate::authorize('update', $fuelLog);
        $vehicle = $fuelLog->vehicle;
        return view('fuel-logs.edit', compact('fuelLog', 'vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFuelLogRequest $request, FuelLog $fuelLog)
    {
        Gate::authorize('update', $fuelLog);
        $fuelLog->update($request->validated());

        return redirect()->route('vehicles.show', $fuelLog->vehicle_id)->with('success', 'Fuel log has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelLog $fuelLog)
    {
        Gate::authorize('delete', $fuelLog);
        $vehicleId = $fuelLog->vehicle_id;
        $fuelLog->delete();

        return redirect()->route('vehicles.show', $vehicleId)->with('success', 'Fuel log has been deleted!');
    }
}
