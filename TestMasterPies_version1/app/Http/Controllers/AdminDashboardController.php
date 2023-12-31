<?php

namespace App\Http\Controllers;
use App\Models\Artisan;
use App\Models\Artisan_city;
use App\Models\Certification;
use App\Models\City;
use App\Models\Post;
use App\Models\Service;
use App\Models\Specialty;
use App\Models\Subscription;
use App\Models\Subscription_history;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function overview()
    {
        try {
            $statistics = [
                'specialties' => DB::table('specialties')
                    ->select('specialties.name', DB::raw('COUNT(artisans.id) AS artisan_count'))
                    ->leftJoin('artisans', 'specialties.id', '=', 'artisans.specialty_id')
                    ->groupBy('specialties.id', 'specialties.name')
                    ->orderByDesc('artisan_count')
                    ->limit(5)
                    ->get(),

                'cities' => DB::table('cities')
                    ->select('cities.name', DB::raw('COUNT(artisan_cities.artisan_id) AS artisan_count'))
                    ->leftJoin('artisan_cities', 'cities.id', '=', 'artisan_cities.city_id')
                    ->groupBy('cities.id', 'cities.name')
                    ->get(),

                'subscriptions_revenue' =>DB::table('subscription_histories')
                ->join('subscriptions', 'subscription_histories.subscription_id', '=', 'subscriptions.id')
                ->select(DB::raw('SUM(subscriptions.cost) AS total_revenue'))
                ->first()->total_revenue,

                'TotalArtisans' =>  DB::table('artisans')->count(),

                'TotalCities' => DB::table('cities')->count(),

                'TOTALREPORTS' => DB::table('reports')->count(),

                // Add other statistics in a similar manner
            ];

            return response()->json(['statistics' => $statistics]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    
    public function getSubscriptionHistory()
    {
        try {
            return Subscription::select('subscriptions.id', 'subscriptions.name', DB::raw('COUNT(subscription_histories.artisan_id) AS artisan_count'))
                ->leftJoin('subscription_histories', 'subscriptions.id', '=', 'subscription_histories.subscription_id')
                ->groupBy('subscriptions.id', 'subscriptions.name') // Include 'subscriptions.name' in GROUP BY
                ->get();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getRecentReports()
    {
        try {
            return DB::table('reports')
                ->select('subject', 'message', 'created_at')
                ->orderByDesc('created_at')
                ->limit(5)
                ->get();
        } catch (\Exception $e) {
            throw $e;
        }
    }

public function artisan_city($artisan_id, $city_id)
{
    $artisan = Artisan::find($artisan_id);
    $city = City::find($city_id);

    if ($artisan->cities()->where('city_id', $city->id)->exists()) {
        return response()->json(['message' => 'Record already exists'], 422);
    }

    $artisan->cities()->attach($city->id);

    return response()->json(['artisans' => $artisan], 200);
}
public function filterAndsearch(Request $request)
{
    // dd($request);
    try {
        $query = User::with(['artisan.specialty'])
            ->where('role_id', '=', 2);

        // Search by name or email
        if ($request->has('SEARCHINPUT')) {
            $searchInput = $request->input('SEARCHINPUT');
            $query->where(function ($query) use ($searchInput) {
                $query->where('name', 'like', '%' . $searchInput . '%')
                    ->orWhere('email', 'like', '%' . $searchInput . '%');
            });
        }

        // Filter by city
        if ($request->has('city_id') && !empty($request->city_id)) {
            $query->whereHas('artisan.cities', function ($query) use ($request) {
                $query->where('city_id', $request->input('city_id'));
            });
        }

        // Filter by specialty
        if ($request->has('specialty_id') && !empty($request->specialty_id)) {
            $query->whereHas('artisan', function ($query) use ($request) {
                $query->where('specialty_id', $request->input('specialty_id'));
            });
        }

        $artisans = $query->get();

        return response()->json(['artisans' => $artisans], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error fetching artisans'], 500);
    }
}

public function artisanServices($id) {
    try {
        $artisan = Artisan::findOrFail($id);
        $services = Service::where('artisan_id', $id)->get();

        return response()->json(['services' => $services], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Handle the case where the artisan with the given ID is not found
        return response()->json(['error' => 'Artisan not found'], 404);
    } catch (\Exception $e) {
        // Handle other exceptions
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function getCitySpecialty(){
    $cities = City::all();
    $specialties = Specialty::all();
    return response()->json(['cities' => $cities,
                            'specialties'=> $specialties]);
}

}
