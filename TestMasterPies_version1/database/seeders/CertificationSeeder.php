<?php

namespace Database\Seeders;

use App\Models\Artisan;
use App\Models\Certification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Get all artisans from the database
            $artisans = Artisan::all();
    
            // Define certification names
            $certificationNames = [
                'Certified Carpenter',
                'Master Woodworker',
                'Artisan of Excellence',
                'Expert Mason',
                'Skilled Blacksmith',
                'Metalworking Specialist',
                'Glass Artisan',
                'Certified Tiler',
                'Master Plumber',
                'Sculpture Artisan',
                'Expert Welder',
                'Cabinet Maker',
                'Stone Carver',
                'Certified Electrician',
                // Add more certification names as needed
            ];
   
            // Seed certifications for each artisan
            foreach ($artisans as $artisan) {
                foreach ($certificationNames as $certificationName) {
                    Certification::create([
                        'name' => $certificationName,
                        'artisan_id' => $artisan->id,
                    ]);
                }
            } 
    }
}
