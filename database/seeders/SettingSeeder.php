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
            'company_name_ar' =>  'إخطار',
            'company_name_en' => 'Ikhtaar',
            'email' => 'info@caa.gov.om',
            'phone' => '+968 24519400',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
