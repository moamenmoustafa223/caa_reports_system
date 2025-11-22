<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'logo' => 'logo.png',
            'company_name_ar' => 'حارس السلامة الذكي',
            'company_name_en' => 'CAA - Civil Aviation Authority',
            'email' => 'info@caa.gov.om',
            'phone' => '+968 24519400',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
