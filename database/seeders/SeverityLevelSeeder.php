<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeverityLevel;

class SeverityLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $severityLevels = [
            [
                'level_key' => 'low',
                'name_ar' => 'منخفض',
                'name_en' => 'Low',
                'order' => 1,
                'color' => '#28a745',
            ],
            [
                'level_key' => 'medium',
                'name_ar' => 'متوسط',
                'name_en' => 'Medium',
                'order' => 2,
                'color' => '#ffc107',
            ],
            [
                'level_key' => 'high',
                'name_ar' => 'عالي',
                'name_en' => 'High',
                'order' => 3,
                'color' => '#fd7e14',
            ],
            [
                'level_key' => 'critical',
                'name_ar' => 'حرج',
                'name_en' => 'Critical',
                'order' => 4,
                'color' => '#dc3545',
            ],
        ];

        foreach ($severityLevels as $level) {
            SeverityLevel::firstOrCreate(
                ['level_key' => $level['level_key']],
                $level
            );
        }
    }
}
