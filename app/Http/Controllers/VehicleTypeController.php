<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the vehicle types.
     */
    public function index()
    {
        $vehicleTypes = VehicleType::all();
        return view('vehicle_type.index', compact('vehicleTypes'));
    }

    /**
     * Show the form for creating a new vehicle type.
     */
    public function create()
    {
        return view('vehicle_type.create');
    }

    /**
     * Store a newly created vehicle type in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:motorcycle,car,other',
            'perjam_pertama' => 'required|integer|min:0',
            'perjam_berikutnya' => 'required|integer|min:0',
            'max_perhari' => 'required|integer|min:0',
        ]);

        // Check if this jenis already exists to avoid duplicates
        $exists = VehicleType::where('jenis', $request->jenis)->exists();
        if ($exists) {
            return redirect()->back()->withInput()->withErrors(['jenis' => 'Vehicle type rate configuration for this type already exists. Please edit it instead.']);
        }

        VehicleType::create($request->all());

        return redirect()->route('vehicle-type.index')->with('success', 'New Vehicle Type was successfully saved!');
    }

    /**
     * Show the form for editing the specified vehicle type.
     */
    public function edit($id)
    {
        $vehicleType = VehicleType::findOrFail($id);
        return view('vehicle_type.edit', compact('vehicleType'));
    }

    /**
     * Update the specified vehicle type in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|in:motorcycle,car,other',
            'perjam_pertama' => 'required|integer|min:0',
            'perjam_berikutnya' => 'required|integer|min:0',
            'max_perhari' => 'required|integer|min:0',
        ]);

        $vehicleType = VehicleType::findOrFail($id);
       
        if ($request->jenis !== $vehicleType->jenis) {
            $exists = VehicleType::where('jenis', $request->jenis)->exists();
            if ($exists) {
                return redirect()->back()->withInput()->withErrors(['jenis' => 'Vehicle type rate configuration for this type already exists.']);
            }
        }

        $vehicleType->update($request->all());

        return redirect()->route('vehicle-type.index')->with('success', 'Vehicle Type was successfully updated!');
    }

    /**
     * Remove the specified vehicle type from storage.
     */
    public function destroy($id)
    {
        $vehicleType = VehicleType::findOrFail($id);
        $vehicleType->delete();

        return redirect()->route('vehicle-type.index')->with('success', 'Vehicle Type was successfully deleted!');
    }
}
