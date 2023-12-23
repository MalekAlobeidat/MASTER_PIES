<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $specialties = [
            // ['name' => 'Carpentry'],
            // ['name' => 'Plumbing'],
            // ['name' => 'Electrician'],
            // ['name' => 'Masonry'],
            // ['name' => 'Painting'],
            // ['name' => 'Landscaping'],
            // ['name' => 'HVAC Technician'],
            // ['name' => 'Roofing'],
            // ['name' => 'Tiling'],
            // ['name' => 'Metalworking'],
            // ['name' => 'Drywall Installation'],
            // ['name' => 'Cabinet Making'],
            // ['name' => 'Welding'],
            // ['name' => 'Concrete Work'],
            // ['name' => 'Flooring'],
            // ['name' => 'Glass Installation'],
            // ['name' => 'Locksmith'],
            // ['name' => 'Sculpting'],
            // ['name' => 'Blacksmithing'],
            // ['name' => 'Stonemasonry'],
            // ['name' => 'Siding Installation'],
            // ['name' => 'Furniture Upholstery'],
            // ['name' => 'Leatherworking'],
            // ['name' => 'Automotive Mechanic'],
            // ['name' => 'Boat Building'],
            // ['name' => 'Pottery'],
            // ['name' => 'Surveying'],
            ['name' => 'Carpentry'],
            ['name' => 'Plumbing'],
            ['name' => 'Electrician'],
            ['name' => 'Masonry'],
            ['name' => 'HVAC Technician'],
            ['name' => 'Blacksmithing'],
            ['name' => 'Furniture Upholstery'],
            // Add more artisan-related jobs as needed
        ];

        // Insert data into the specialties table
        foreach ($specialties as $specialty) {
            DB::table('specialties')->insert([
                'name' => $specialty['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
