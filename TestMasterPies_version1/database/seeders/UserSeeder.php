<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


            // Create 10 users with role ID 2
            
            DB::table('users')->insert([
                // [
                //     'name' => 'yousef',
                //     'email' => 'client@gmail.com',
                //     'password' => Hash::make('123123'),
                //     'role_id' => 3,
                //     'created_at' => now(),
                //     'updated_at' => now(),
                // ],
                [
                    'name' => 'mousa',
                    'email' => 'artisan@gmail.com',
                    'password' => Hash::make('123123'),
                    'role_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'malek',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('123123'),
                    'role_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
            User::factory(24)->create();
        }
    }
