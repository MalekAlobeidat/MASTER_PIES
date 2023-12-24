<?php

namespace App\Http\Controllers;

use App\Models\Artisan_city;
use Illuminate\Http\Request;

class ArtisanCityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artisanCities = Artisan_city::with(['artisan.user', 'city'])->get();

        return response()->json(['artisanCities' => $artisanCities], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'artisan_id' => 'required|exists:artisans,id',
            'city_id' => 'required|exists:cities,id',
        ]);
        $artisanCity = Artisan_city::create($request->all());

        return response()->json(['artisanCity' => $artisanCity], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ArtisansCity = Artisan_city::with(['city'])->where('artisan_id','=',$id)->get();
        return response()->json(['artisanCity' => $ArtisansCity], 200);
    }


    /*
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $artisanCity = Artisan_city::findOrFail($id);

        $request->validate([
            'artisan_id' => 'required|exists:artisans,id',
            'city_id' => 'required|exists:cities,id',
        ]);
        $artisanCity->update($request->all());
        return response()->json(['artisanCity' => $artisanCity], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($artisanId, $cityId)
    {
        // Find the record based on artisan_id and city_id
        $record = Artisan_city::where('artisan_id', $artisanId)
            ->where('city_id', $cityId)
            ->first();

        // Check if a record exists
        if ($record) {
            try {
                // Delete the record
                $record->delete();
                return response()->json(['message' => 'Record deleted successfully'], 200);
            } catch (\Exception $e) {
                // Handle the exception
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            // Return a response indicating no matching record
            return response()->json(['message' => 'No matching record found'], 404);
        }
    }
}
