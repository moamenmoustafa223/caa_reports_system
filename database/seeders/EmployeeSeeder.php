<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                "employee_no" => '001',
                'category_employees_id' => 1,
                'name' => 'محمد احمد خالد / Mohamed Ahmed Khaled',
                'phone' => '95445431',
                'email' => 'mohamed@company.com',
            ],
            [
                "employee_no" => '002',
                'category_employees_id' => 2,
                'name' => 'خالد سعيد العامري / Khalid Said Al Amri',
                'phone' => '95445432',
                'email' => 'khalid@company.com',
            ],
            [
                "employee_no" => '003',
                'category_employees_id' => 3,
                'name' => 'سارة ناصر الزدجالي / Sara Nasser Al Zadjali',
                'phone' => '95445433',
                'email' => 'sara@company.com',
            ],
            [
                "employee_no" => '004',
                'category_employees_id' => 1,
                'name' => 'عبدالله حمد الرواحي / Abdullah Hamad Al Rawahi',
                'phone' => '95445434',
                'email' => 'abdullah@company.com',
            ],
        ];

        foreach ($employees as $employee) {
            DB::table('employees')->insert([
                "user_id" => 1,
                "employee_no" => $employee['employee_no'],
                "category_employees_id" => $employee['category_employees_id'],
                "image" => 'avatar.png',
                "name" => $employee['name'],
                "phone" => $employee['phone'],
                "email" => $employee['email'],
                "password" => Hash::make('123123'),
                "status" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ]);
        }
    }
}
