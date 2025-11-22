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
                'name_ar' => 'محمد احمد خالد',
                'name_en' => 'Mohamed Ahmed Khaled',
                'id_number' => '65987469',
                'phone' => '95445431',
                'email' => 'mohamed@company.com',
                'Nationality' => 'عماني',
            ],
            [
                "employee_no" => '002',
                'category_employees_id' => 2,
                'name_ar' => 'خالد سعيد العامري',
                'name_en' => 'Khalid Said Al Amri',
                'id_number' => '78854123',
                'phone' => '95445432',
                'email' => 'khalid@company.com',
                'Nationality' => 'عماني',
            ],
            [
                "employee_no" => '003',
                'category_employees_id' => 3,
                'name_ar' => 'سارة ناصر الزدجالي',
                'name_en' => 'Sara Nasser Al Zadjali',
                'id_number' => '77452136',
                'phone' => '95445433',
                'email' => 'sara@company.com',
                'Nationality' => 'عمانية',
            ],
            [
                "employee_no" => '004',
                'category_employees_id' => 1,
                'name_ar' => 'عبدالله حمد الرواحي',
                'name_en' => 'Abdullah Hamad Al Rawahi',
                'id_number' => '66554432',
                'phone' => '95445434',
                'email' => 'abdullah@company.com',
                'Nationality' => 'عماني',
            ],
        ];

        foreach ($employees as $employee) {
            DB::table('employees')->insert([
                "user_id" => 1,
                "employee_no" => $employee['employee_no'],
                "category_employees_id" => $employee['category_employees_id'],
                "image" => 'avatar.png',

                "name_ar" => $employee['name_ar'],
                "name_en" => $employee['name_en'],

                "phone" => $employee['phone'],
                "email" => $employee['email'],
                "password" => Hash::make('123123'),

                "Nationality" => $employee['Nationality'],
                "id_number" => $employee['id_number'],
                "status" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ]);
        }
    }
}
