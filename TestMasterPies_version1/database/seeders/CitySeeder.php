<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Amman',
            'Irbid',
            'Zarqa',
            'Aqaba',
            'Madaba',
            'Jerash',
            // Add more cities as needed
        ];

        // Insert data into the cities table
        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'name' => $city,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
