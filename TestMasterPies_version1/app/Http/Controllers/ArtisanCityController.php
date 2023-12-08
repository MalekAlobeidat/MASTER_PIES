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
        $artisanCities = Artisan_city::with(['artisan', 'city'])->get();

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
    public function destroy($id)
    {
        $artisanCity = Artisan_city::findOrFail($id);
        $artisanCity->delete();
        return response()->json(['message' => 'ArtisanCity deleted successfully'], 200);
    }
}
