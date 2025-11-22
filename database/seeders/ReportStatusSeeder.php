<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReportStatus;

class ReportStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name_ar' => 'مستلم',
                'name_en' => 'Received',
                'color' => '#6c757d',
                'description' => 'تم استلام البلاغ',
         
            ],
            [
                'name_ar' => 'قيد المراجعة',
                'name_en' => 'Under Review',
                'color' => '#0dcaf0',
                'description' => 'البلاغ قيد المراجعة من قبل الفريق المختص',
            
            ],
            [
                'name_ar' => 'قيد التنفيذ',
                'name_en' => 'In Progress',
                'color' => '#0d6efd',
                'description' => 'جاري العمل على معالجة البلاغ',
            
            ],
            [
                'name_ar' => 'تم الحل',
                'name_en' => 'Resolved',
                'color' => '#198754',
                'description' => 'تم حل البلاغ بنجاح',
            ],
            [
                'name_ar' => 'مرفوض',
                'name_en' => 'Rejected',
                'color' => '#dc3545',
                'description' => 'تم رفض البلاغ',
                
            ],
            [
                'name_ar' => 'مؤجل',
                'name_en' => 'Deferred',
                'color' => '#ffc107',
                'description' => 'تم تأجيل البلاغ',
                
            ],
        ];

        foreach ($statuses as $status) {
            ReportStatus::firstOrCreate(
                ['name_en' => $status['name_en']],
                $status
            );
        }
    }
}
