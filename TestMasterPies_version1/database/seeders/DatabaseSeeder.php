<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Certification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        // \App\Models\User::factory(24)->create();
        $this->call(SubscriptionSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(SpecialtySeeder::class);
        $this->call(ReportSeeder::class);
        $this->call(ArtisanSeeder::class);
        $this->call(CertificationSeeder::class);
        $this->call(ArtisanSubscriptionSeeder::class);
        $this->call(ArtisanCitySeeder::class);
        $this->call(SubscriptionHistorySeeder::class);

        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
