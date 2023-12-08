<?php

namespace Database\Seeders;

use App\Models\Artisan;
use App\Models\Specialty;
use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artisanIds = Artisan::pluck('id');
        $subscriptionIds = Subscription::pluck('id');
        $numberOfRecords = 5;

        // Generate subscription history records
        for ($i = 1; $i <= $numberOfRecords; $i++) {
            DB::table('subscription_histories')->insert([
                'subscription_id' => $subscriptionIds->random(),
                'artisan_id' => $artisanIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
