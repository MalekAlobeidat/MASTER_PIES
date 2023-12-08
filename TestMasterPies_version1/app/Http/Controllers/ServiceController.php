<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('artisan','user')->get();

        return response()->json(['services' => $services], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'estimated_time' => 'nullable|integer',
            'pricing' => 'nullable|numeric',
            'artisan_id' => 'required|exists:artisans,id',
        ]);
        $service = new service([
            'name' => $request->name,
            'estimated_time' => $request->estimated_time,
            'artisan_id' =>$request->artisan_id,
            'pricing' =>$request->pricing
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
            $service->image = 'http://127.0.0.1:8000/storage' . '/' . $path;
        }
        $service->save();
        return response()->json(['service' => $service], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = Service::with('artisan')->findOrFail($id);

        return response()->json(['service' => $service], 200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $service = Service::findOrFail($id);
    
            $request->validate([
                'name' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'estimated_time' => 'required', // Remove incorrect validation for image
                'pricing' => 'nullable|numeric',
                'artisan_id' => 'required|exists:artisans,id',
            ]);
    
            $service->update($request->except('image'));
    
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($service->image) {
                    Storage::delete('public/' . $service->image);
                }
    
                // Upload the new image
                $imagePath = $request->file('image')->store('public/images');
                $service->image = 'http://127.0.0.1:8000/storage' . '/' . str_replace('public/', '', $imagePath);
                $service->save();
            }
    
            return response()->json(['service' => $service], 200);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json(['message' => 'Service deleted successfully'], 200);
    }
}
