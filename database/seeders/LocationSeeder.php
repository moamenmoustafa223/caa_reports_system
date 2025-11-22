<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name_ar' => 'مطار صلالة',
                'name_en' => 'Salalah Airport',
                'status' => 1,
            ],
        ];

        foreach ($locations as $location) {
            Location::firstOrCreate(
                ['name_ar' => $location['name_ar']],
                $location
            );
        }
    }
}
