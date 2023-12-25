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
            
            
            

        ];

        // Seed certifications for each artisan
        foreach ($artisans as $artisan) {
            // Ensure each artisan has at least 1 certification
            Certification::create([
                'name' => array_shift($certificationNames),
                'artisan_id' => $artisan->id,
            ]);

            // Randomly shuffle certification names for variety
            shuffle($certificationNames);

            // Get up to 2 additional certifications for the artisan
            for ($i = 0; $i < min(0, count($certificationNames)); $i++) {
                Certification::create([
                    'name' => array_shift($certificationNames),
                    'artisan_id' => $artisan->id,
                ]);
            }
        }
    }
}
