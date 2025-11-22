<?php

namespace Database\Seeders;

use App\Models\SafetyTip;
use App\Models\User;
use Illuminate\Database\Seeder;

class SafetyTipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::first()->id ?? 1;

        $tips = [
            [
                'user_id' => $userId,
                'title_ar' => 'معدات الوقاية',
                'title_en' => 'PPE',
                'description_ar' => 'خوذة • قفازات • سترة',
                'description_en' => 'Helmet • Gloves • Vest',
                'icon' => '🦺',
                'order' => 1,
                'status' => 1,
            ],
            [
                'user_id' => $userId,
                'title_ar' => 'إجهاد الحرارة',
                'title_en' => 'Heat Stress',
                'description_ar' => 'اشرب الماء وخذ فترات راحة',
                'description_en' => 'Hydrate • Work/Rest cycles',
                'icon' => '🌡️',
                'order' => 2,
                'status' => 1,
            ],
            [
                'user_id' => $userId,
                'title_ar' => 'السلامة الكهربائية',
                'title_en' => 'Electrical Safety',
                'description_ar' => 'قفل/علامة',
                'description_en' => 'Lockout/Tagout',
                'icon' => '⚡',
                'order' => 3,
                'status' => 1,
            ],
            [
                'user_id' => $userId,
                'title_ar' => 'الإسعافات الأولية',
                'title_en' => 'First Aid',
                'description_ar' => 'اتصل بفرق الطوارئ فورًا',
                'description_en' => 'Contact emergency teams immediately',
                'icon' => '🚑',
                'order' => 4,
                'status' => 1,
            ],
        ];

        foreach ($tips as $tip) {
            SafetyTip::create($tip);
        }
    }
}
