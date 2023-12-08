<?php

namespace Database\Seeders;

use App\Models\Artisan;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Adjust the number based on how many artisans you want to create
        $numberOfArtisans = 10;
        $specialtyIds = Specialty::pluck('id');

        // Use the Artisan factory to create artisans with random data
        User::where('role_id', 2)->get()->each(function ($user) use ($specialtyIds) {
            Artisan::factory()->create([
                'user_id' => $user->id,
                'specialty_id' => $specialtyIds->random(),
                // Add other specific artisan data if needed
            ]);
        });
    }
}
