<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptions = [
            ['name' => 'VIP1', 'duration' => 30, 'cost' => 19.99],
            ['name' => 'VIP2', 'duration' => 60, 'cost' => 29.99],
            ['name' => 'VIP3', 'duration' => 90, 'cost' => 39.99],
            // Add more subscription data as needed
        ];

        // Insert data into the subscriptions table
        DB::table('subscriptions')->insert($subscriptions);
    }
}
