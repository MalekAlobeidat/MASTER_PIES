<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::all();

        return response()->json(['subscriptions' => $subscriptions], 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subscriptions|max:255',
            'duration' => 'required|integer',
            'cost' => 'nullable|numeric',
        ]);

        $subscription = Subscription::create($request->all());

        return response()->json(['subscription' => $subscription], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);

        return response()->json(['subscription' => $subscription], 200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:subscriptions,name,' . $subscription->id . '|max:255',
            'duration' => 'required|integer',
            'cost' => 'nullable|numeric',
        ]);

        $subscription->update($request->all());

        return response()->json(['subscription' => $subscription], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return response()->json(['message' => 'Subscription deleted successfully'], 200);
    }
}
