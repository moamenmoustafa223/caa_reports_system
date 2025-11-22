<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {


        //        \App\Models\Customer::factory(5)->create();


        $this->call([
            SettingSeeder::class,
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            CategoryEmployeesSeeder::class,
            EmployeeSeeder::class,
            ReportStatusSeeder::class,
            LocationSeeder::class,
            SeverityLevelSeeder::class,
            SafetyTipSeeder::class,
        ]);
    }
}
