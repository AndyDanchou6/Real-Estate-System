<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    // Create a new property
    public function store(Request $request)
    {
        $property = Property::create($request->all());
        return response()->json($property, 201);
    }

    // Return all properties
    public function index()
    {
        $properties = Property::all();
        return response()->json($properties);
    }

    // Return a single property by id
    public function show($id)
    {
        $property = Property::findOrFail($id);
        return response()->json($property);
    }

    // Update a property
    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        $property->update($request->all());
        return response()->json($property);
    }

    // Delete a property
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        return response()->json(null, 204);
    }

    // Search for properties by title, location, or owner
    public function search(Request $request)
    {
        $query = Property::query();

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->has('owner')) {
            $query->where('owner', 'like', '%' . $request->owner . '%');
        }

        $properties = $query->get();

        return response()->json($properties);
    }
}
