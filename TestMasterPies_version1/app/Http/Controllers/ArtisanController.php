<?php

namespace App\Http\Controllers;
use App\Models\Artisan_city;
use App\Models\Artisan;
use Illuminate\Http\Request;

class ArtisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $artisans = Artisan::with(['user', 'specialty', 'services'])->get();
            return response()->json(['artisans' => $artisans], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching artisans'], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $artisan = Artisan::with(['user', 'specialty', 'services'])->findOrFail($id);
            $artisan_cities = Artisan_city::where('artisan_id', $id)->get();
    
            return response()->json([
                'artisan' => $artisan,
                'artisan_cities' => $artisan_cities
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching artisan details'], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    try {
        $artisan = Artisan::findOrFail($id);

        $request->validate([
            'years_of_experience' => 'required|integer',
            'jerny' => 'nullable|string',
            'formal_education' => 'nullable|string',
            'apprenticeships' => 'nullable|string',
            'association_memberships' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'specialty_id' => 'nullable|exists:specialties,id',
            'phone_number' => 'required|string',
        ]);

        $artisan->update($request->all());

        return response()->json(['artisan' => $artisan], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error updating artisan'], 500);
    }
    }

}
