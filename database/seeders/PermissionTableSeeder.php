<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{


    public function run()
    {
        $permissions = [
            'dashboard',

            
            // التقارير
            'reports_all',
            'reports_all_between_two_dates',

            'CategoryEmployees',
            'CategoryEmployees_add',
            'CategoryEmployees_edit',
            'CategoryEmployees_delete',
            'CategoryEmployees_show',

            'Employees',
            'Employees_add',
            'Employees_edit',
            'Employees_delete',
            'Employees_show',
            'Employees_search',

            'Employees_Images',
            'Employees_Images_add',
            'Employees_Images_edit',
            'Employees_Images_delete',
            'Employees_Images_show',


            'users',
            'users_add',
            'users_edit',
            'users_delete',
            'users_show',

            'roles',
            'roles_add',
            'roles_edit',
            'roles_delete',
            'roles_show',


            'Setting',
            'notification',
            'search_dashboard',

            // Reporting System - Locations
            'locations',
            'add_location',
            'edit_location',
            'delete_location',
            'show_location',
            'export_location',

            // Reporting System - Severity Levels
            'severity_levels',
            'add_severity_level',
            'edit_severity_level',
            'delete_severity_level',
            'show_severity_level',
            'export_severity_level',

            // Reporting System - Report Statuses
            'report_statuses',
            'add_report_status',
            'edit_report_status',
            'delete_report_status',
            'show_report_status',
            'export_report_status',

            'safety_tips',
            'add_safety_tip',
            'edit_safety_tip',
            'delete_safety_tip',
            'show_safety_tip',
            'export_safety_tip',

            // Reporting System - Reports
            'reports',
            'add_report',
            'edit_report',
            'delete_report',
            'show_report',
            'export_report',
            'change_report_status',

            // Reporting System - Report Attachments
            'report_attachments',
            'add_report_attachment',
            'edit_report_attachment',
            'delete_report_attachment',
            'show_report_attachment',
            'download_report_attachment',

            // Reporting System - Report Trackings
            'report_trackings',
            'add_report_tracking',
            'show_report_tracking',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
