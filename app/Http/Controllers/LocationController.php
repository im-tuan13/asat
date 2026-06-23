<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the locations.
     */
    public function index()
    {
        $locations = Location::all();
        return view('location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new location.
     */
    public function create()
    {
        return view('location.create');
    }

    /**
     * Store a newly created location in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:100',
            'max_motorcycle' => 'required|integer|min:0',
            'max_car' => 'required|integer|min:0',
            'max_other' => 'required|integer|min:0',
        ]);

        Location::create($request->all());

        return redirect()->route('location.index')->with('success', 'New Location was successfully saved!');
    }

    /**
     * Show the form for editing the specified location.
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('location.edit', compact('location'));
    }

    /**
     * Update the specified location in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'location_name' => 'required|string|max:100',
            'max_motorcycle' => 'required|integer|min:0',
            'max_car' => 'required|integer|min:0',
            'max_other' => 'required|integer|min:0',
        ]);

        $location = Location::findOrFail($id);
        $location->update($request->all());

        return redirect()->route('location.index')->with('success', 'Location was successfully updated!');
    }

    /**
     * Remove the specified location from storage.
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('location.index')->with('success', 'Location was successfully deleted!');
    }
}
