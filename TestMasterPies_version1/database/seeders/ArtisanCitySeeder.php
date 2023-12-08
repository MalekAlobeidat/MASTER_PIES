<?php

namespace Database\Seeders;

use App\Models\Artisan;
use App\Models\City;
use App\Models\Artisan_city;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtisanCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artisanIds = Artisan::pluck('id');
        $cityIds = City::pluck('id');

        // Create artisan_cities entries
        foreach ($artisanIds as $artisanId) {
            Artisan_city::create([
                'artisan_id' => $artisanId,
                'city_id' => $cityIds->random(),
            ]);
        }
    }
}
