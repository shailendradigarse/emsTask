<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List of locations
        $locations = [
            'Malta',
            'Brazil',
            'Africa',
            'Asia',
            'East Europe',
            'Eurasia'
        ];

        // Loop through the locations and create an event for each
        foreach ($locations as $location) {
            Event::create([
                'name' => $location . ' Summit 2024',
                'location' => $location,
                'date' => now()->addMonths(rand(1, 12)), // Random future date
                'description' => 'A major event happening in ' . $location . ' in 2024.',
            ]);
        }
    }
}
