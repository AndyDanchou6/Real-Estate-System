<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function store(Request $request)
    {
        $id = Auth::user()->id;

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'type' => 'required|string|in:house,land,commercial',
            'size' => 'required|numeric',
            'bedrooms' => 'nullable|numeric',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'nullable|numeric',
            'monthly' => 'nullable|numeric',
            'term' => 'nullable|numeric',
            'rent' => 'nullable|numeric',
            'adType' => 'required|string|in:forSale,forRent',
        ]);

        $validatedData['agent_id'] = $id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $validatedData['image'] = $imagePath;
        }

        if (Property::create($validatedData)) {
            return response()->json([
                'status' => 200,
                'message' => 'Property added successfully',
            ]);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Property addition failed',
        ]);
    }

    public function getAll()
    {
        $properties = Property::all();
        return response()->json($properties);
    }

    public function show($id)
    {
        $property = Property::with('agent')
            ->findOrFail($id);

        return response()->json($property);
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if ($request->hasFile('image')) {
            $avatarPath = $request->file('image')->store('img', 'public');
            $property->image = 'storage/' . $avatarPath;
        }

        $property->title = $request->input('title');
        $property->owner = $request->input('owner');
        $property->location = $request->input('location');
        $property->size = $request->input('size');
        $property->bedrooms = $request->input('bedrooms');
        $property->monthly = $request->input('monthly');
        $property->rent = $request->input('rent');
        $property->price = $request->input('price');
        $property->term = $request->input('term');
        $property->adType = $request->input('adType');

        if ($property->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Update successfull',
            ]);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Update unsuccessfull',
        ]);
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        if ($property->delete()) {

            return response()->json([
                'status' => 200,
                'message' => 'Successfully deleted'
            ]);
        }
        return response()->json([
            'status' => 500,
            'message' => 'Deletion failed'
        ]);
    }

    public function search($data)
    {
        $query = Property::where('title', 'like', '%' . $data . '%')
            ->orWhere('location', 'like', '%' . $data . '%')
            ->orWhere('adType', 'like', '%' . $data . '%')
            ->orWhere('owner', 'like', '%' . $data . '%');

        $properties = $query->get();

        return response()->json($properties);
    }

    public function searchHouse($data)
    {
        $houses = Property::where('type', 'house')
            ->where(function ($query) use ($data) {
                $query->where('title', 'like', '%' . $data . '%')
                    ->orWhere('location', 'like', '%' . $data . '%')
                    ->orWhere('adType', 'like', '%' . $data . '%')
                    ->orWhere('owner', 'like', '%' . $data . '%');
            })
            ->get();

        return response()->json($houses);
    }

    public function searchLand($data)
    {
        $land = Property::where('type', 'land')
            ->where(function ($query) use ($data) {
                $query->where('title', 'like', '%' . $data . '%')
                    ->orWhere('location', 'like', '%' . $data . '%')
                    ->orWhere('adType', 'like', '%' . $data . '%')
                    ->orWhere('owner', 'like', '%' . $data . '%');
            })
            ->get();

        return response()->json($land);
    }

    public function searchCommercial($data)
    {
        $commercial = Property::where('type', 'commercial')
            ->where(function ($query) use ($data) {
                $query->where('title', 'like', '%' . $data . '%')
                    ->orWhere('location', 'like', '%' . $data . '%')
                    ->orWhere('adType', 'like', '%' . $data . '%')
                    ->orWhere('owner', 'like', '%' . $data . '%');
            })
            ->get();

        return response()->json($commercial);
    }

    public function house()
    {
        $properties = Property::where('type', 'house')
            ->with('agent')
            ->get();
        return response()->json($properties);
    }

    public function land()
    {
        $properties = Property::where('type', 'land')
            ->with('agent')
            ->get();
        return response()->json($properties);
    }

    public function commercial()
    {
        $properties = Property::where('type', 'commercial')
            ->with('agent')
            ->get();
        return response()->json($properties);
    }

    public function forSale()
    {
        $properties = Property::where('adType', 'forSale')
            ->with('agent')
            ->get();
        return response()->json($properties);
    }

    public function forRent()
    {
        $properties = Property::where('adType', 'forRent')
            ->with('agent')
            ->get();
        return response()->json($properties);
    }
}
