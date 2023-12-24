<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reports = Report::all();
            return response()->json(['reports' => $reports], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching reports'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'subject' => 'required|max:255',
                'message' => 'required',
                'user_id' => 'required|exists:users,id',
            ]);

            $report = Report::create($request->all());
    
            return response()->json(['report' => $report], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating report'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $report = Report::with('user')->findOrFail($id);

        return response()->json(['report' => $report], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $report = Report::findOrFail($id);
            $report->delete();
            return response()->json(['message' => 'Report deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Report not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting report'], 500);
        }
    }
}