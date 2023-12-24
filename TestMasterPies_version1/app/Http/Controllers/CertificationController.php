<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $certifications = Certification::with('artisan')->get();
            return response()->json(['certifications' => $certifications], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching certifications'], 500);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'artisan_id' => 'required|exists:artisans,id',
            ]);
    
            $certification = Certification::create($request->all());
    
            return response()->json(['certification' => $certification], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating certification'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $certification = Certification::findOrFail($id);
    
            $request->validate([
                'name' => 'required|string',
                'artisan_id' => 'required|exists:artisans,id',
            ]);
    
            $certification->update($request->all());
    
            return response()->json(['certification' => $certification], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating certification'], 500);
        }
    }

    public function show($id)
    {
        $certification = Artisan::with('certifications')->where('id',$id)->get();

        return response()->json(['$certification' => $certification], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $certification = Certification::findOrFail($id);
            $certification->delete();
    
            return response()->json(['message' => 'Certification deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting certification'], 500);
        }
    }
}
