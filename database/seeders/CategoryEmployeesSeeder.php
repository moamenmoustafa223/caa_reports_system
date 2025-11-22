<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryEmployeesSeeder extends Seeder
{


    public function run()
    {
        $categories = [
            ['name' => 'الاستطلاع', 'name_en' => 'Reconnaissance'],
            ['name' => 'الملاحة', 'name_en' => 'Navigation'],
            ['name' => 'الاتصالات', 'name_en' => 'Communications'],
            ['name' => 'الاقتراب', 'name_en' => 'Approach'],
            ['name' => 'الصيانة', 'name_en' => 'Maintenance'],
            ['name' => 'الأرصاد الجوية', 'name_en' => 'Meteorology'],
            ['name' => 'تقنية المعلومات', 'name_en' => 'Information Technology'],
        ];

        foreach ($categories as $category) {
            DB::table('category_employees')->insert([
                "user_id" => 1,
                'name' => $category['name'],
                'name_en' => $category['name_en'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
