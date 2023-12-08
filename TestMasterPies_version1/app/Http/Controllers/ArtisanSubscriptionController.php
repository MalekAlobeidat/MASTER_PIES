<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use App\Models\Artisan_subscription;
use App\Models\Subscription;
use App\Models\Subscription_history;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArtisanSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artisanSubscriptions = Artisan_subscription::with(['subscription', 'artisan'])->get();

        return response()->json(['artisan_subscriptions' => $artisanSubscriptions], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'artisan_id' => 'required|exists:artisans,id',
        ]);
        $subscription = Subscription::findOrFail($request->input('subscription_id'));
        $artisan = Artisan::findOrFail($request->input('artisan_id'));
    
        // Check if the artisan subscription already exists
        $existingSubscription = Artisan_subscription::where('artisan_id', $request->input('artisan_id'))
            ->first();
    
            $currentDate = now();
        if ($existingSubscription) {
                if ($currentDate < $existingSubscription->end_date) {
                    $endDate = $existingSubscription->end_date;
                    $start_date = $existingSubscription->start_date;
                    $existingSubscription->start_date = Carbon::parse($start_date)->toDateString();
                    $existingSubscription->end_date = Carbon::parse($endDate)->addDays($subscription->duration)->toDateString();
                    if ($request->subscription_id > $existingSubscription->subscription_id ){
                        $existingSubscription->subscription_id = $request->input('subscription_id');
                    }
                    $existingSubscription->save();
                    $subscriptionHistory = Subscription_history::create([
                        'subscription_id' => $request->subscription_id, // Replace with a valid subscription ID
                        'artisan_id' => $request->artisan_id,      // Replace with a valid artisan ID
                    ]);
            
                    return response()->json([
                        'message' => 'Artisan subscription updated successfully',
                        'Artisan_subsicribtion' => $existingSubscription
                    ], 200);
                }
            $existingSubscription->delete();
        }
        $subscriptionHistory = Subscription_history::create([
            'subscription_id' => $request->subscription_id, // Replace with a valid subscription ID
            'artisan_id' => $request->artisan_id,      // Replace with a valid artisan ID
        ]);
        $artisanSubscription = Artisan_subscription::create([
            'subscription_id' => $request->subscription_id, // Replace with a valid subscription ID
            'artisan_id' => $request->artisan_id,      // Replace with a valid artisan ID
            'start_date' => now(),
            'end_date' => now()->addDays($subscription->duration),
        ]);

        return response()->json(['artisan_subscription' => $artisanSubscription,
                                    'subscriptionHistory'=>$subscriptionHistory], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $artisanSubscription = Artisan_subscription::with(['subscription', 'artisan'])->findOrFail($id);

        return response()->json(['artisan_subscription' => $artisanSubscription], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $artisanSubscription = Artisan_subscription::findOrFail($id);

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'subscription_id' => 'required|exists:subscriptions,id',
            'artisan_id' => 'required|exists:artisans,id',
        ]);

        $artisanSubscription->update($request->all());

        return response()->json(['artisan_subscription' => $artisanSubscription], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $artisanSubscription = Artisan_subscription::findOrFail($id);
        $artisanSubscription->delete();

        return response()->json(['message' => 'Artisan subscription deleted successfully'], 200);
    }
}
