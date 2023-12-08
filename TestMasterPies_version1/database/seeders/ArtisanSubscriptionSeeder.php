<?php

namespace Database\Seeders;
use App\Models\Artisan;
use App\Models\Artisan_subscription;
use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtisanSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Get artisan and subscription IDs
                $artisanIds = Artisan::pluck('id');
                $subscriptionIds = Subscription::pluck('id');
        
                // Create four artisan subscriptions
                for ($i = 0; $i < 4; $i++) {
                    Artisan_subscription::create([
                        'start_date' => now()->subDays($i * 30), // Adjust the date logic as needed
                        'end_date' => now()->addDays(($i + 1) * 30), // Adjust the date logic as needed
                        'subscription_id' => $subscriptionIds->random(),
                        'artisan_id' => $artisanIds->random(),
                    ]);
                }
    }
}
