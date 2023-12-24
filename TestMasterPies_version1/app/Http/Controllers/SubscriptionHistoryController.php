<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use App\Models\Subscription_history;
use Illuminate\Http\Request;

class SubscriptionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptionHistories = Subscription_history::with(['subscription', 'artisan'])->get();

        return response()->json(['subscription_histories' => $subscriptionHistories], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $subscriptionHistory = Subscription_history::with(['subscription'])->where('artisan_id',$id)
        ->where('artisan_id', '=', $id)
        ->get();
        return response()->json(['subscription_history' => $subscriptionHistory], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subscriptionHistory = Subscription_history::findOrFail($id);





        $subscriptionHistory->delete();
        return response()->json(['message' => 'Subscription history deleted successfully'], 200);
    }
}
