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
            $artisan_cities = Artisan_city::with('city')->where('artisan_id', $id)->get();
            // $city = City::where($artisan_cities->)
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
            // Attempt to find the artisan by ID
            $artisan = Artisan::findOrFail($id);

            // Validate the request data
            $request->validate([
                'years_of_experience' => 'required|integer',
                'jerny' => 'nullable|string',
                'formal_education' => 'nullable|string',
                'apprenticeships' => 'nullable|string',
                'association_memberships' => 'nullable|string',
                'specialty_id' => 'nullable|exists:specialties,id',
                'phone_number' => 'required',
            ]);

            // dd($request);
            // Update the artisan with the new data
            $artisan->update($request->all());

            // Return a success response
            return response()->json(['artisan' => $artisan], 200);

        } catch (ModelNotFoundException $e) {
            // Handle the case where the artisan with the given ID was not found
            return response()->json(['error' => 'Artisan not found'], 404);

        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['error' => $e->errors()], 422);

        } catch (\Exception $e) {
            // Catch any other general exceptions
            \Log::error('Error updating artisan: ' . $e->getMessage());

            return response()->json(['error' => 'Error updating artisan'], 500);
        }
    }


}
