<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // Add this line

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('specialties')->truncate();

        $specialties = [
            ['id' => 2, 'name' => 'Plumbing'],
            ['id' => 3, 'name' => 'Electrician'],
            ['id' => 19, 'name' => 'Blacksmithing'],
            ['id' => 26, 'name' => 'Furniture Upholstery'],
            ['id' => 28, 'name' => 'Carpentry'],
            // Add more artisan-related jobs as needed
        ];

        // Insert data into the specialties table
        foreach ($specialties as $specialty) {
            DB::table('specialties')->insert([
                'id' => $specialty['id'],
                'name' => $specialty['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        Schema::enableForeignKeyConstraints();

    }
}
