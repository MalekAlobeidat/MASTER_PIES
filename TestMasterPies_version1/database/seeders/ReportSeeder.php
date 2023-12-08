<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $reports = [
            [
                'subject' => 'Network Connectivity Issue',
                'message' => 'Users reported intermittent network connectivity issues.',
                'user_id' => 2,
            ],
            [
                'subject' => 'Login Problems',
                'message' => 'Some users are experiencing difficulties logging into their accounts.',
                'user_id' => 2,
            ],
            [
                'subject' => 'Data Loss Incident',
                'message' => 'A few users reported data loss after a recent update.',
                'user_id' => 3,
            ],
            [
                'subject' => 'Application Crashing',
                'message' => 'Several users mentioned the application crashing unexpectedly.',
                'user_id' => 3,
            ],
            [
                'subject' => 'Server Downtime',
                'message' => 'Several users reported that the application is inaccessible due to server downtime.',
                'user_id' => 2,
            ],
            [
                'subject' => 'Payment Processing Issue',
                'message' => 'Users are facing difficulties while trying to make payments through the application.',
                'user_id' => 2,
            ],
            [
                'subject' => 'Mobile App Crashes on iOS',
                'message' => 'Users with iOS devices reported frequent crashes when using the mobile app.',
                'user_id' => 2,
            ],
            [
                'subject' => 'Password Reset Not Working',
                'message' => 'Users are unable to reset their passwords using the provided password reset functionality.',
                'user_id' => 2,
            ],
            [
                'subject' => 'Missing Data in Reports',
                'message' => 'Some users noticed that certain data is missing from the generated reports.',
                'user_id' => 2,
            ],
            [
                'subject' => 'Security Concerns',
                'message' => 'A user raised concerns about the security practices of the application.',
                'user_id' => 3,
            ],
            // Add more reports as needed
        ];

        // Insert data into the reports table
        foreach ($reports as $report) {
            DB::table('reports')->insert([
                'subject' => $report['subject'],
                'message' => $report['message'],
                'user_id' => $report['user_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
