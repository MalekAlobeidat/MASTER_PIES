<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialties = Specialty::all();

        return response()->json(['specialties' => $specialties], 200);
    }



    /**
     * Store a newly created resource in storage.
     */    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:specialties|max:255',
        ]);

        $specialty = Specialty::create($request->all());

        return response()->json(['specialty' => $specialty], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $specialty = Specialty::findOrFail($id);

        return response()->json(['specialty' => $specialty], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $specialty = Specialty::findOrFail($id);

        $request->validate([
            'name' => 'required',
        ]);

        $specialty->update($request->all());

        return response()->json(['specialty' => $specialty], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $specialty = Specialty::findOrFail($id);
        $specialty->delete();

        return response()->json(['message' => 'Specialty deleted successfully'], 200);
    }
}
