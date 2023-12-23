<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::all();

        return response()->json(['cities' => $cities], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:cities|max:255',
            ]);

            $city = City::create($request->all());

            return response()->json(['city' => $city], 201);
        } catch (QueryException $e) {
            // Handle database-related exceptions (e.g., unique constraint violation)
            return response()->json(['error' => 'Error creating city: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Handle other general exceptions
            return response()->json(['error' => 'Error creating city: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $city = City::findOrFail($id);

        return response()->json(['city' => $city], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $city->update($request->all());

        return response()->json(['city' => $city], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json(['message' => 'City deleted successfully'], 200);
    }
}
