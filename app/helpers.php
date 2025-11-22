<?php

use Illuminate\Support\Str;

if (! function_exists('normalizePhoneNumber')) {
    function normalizePhoneNumber($phone, $phoneCode)
    {
        // أزل أي رموز غير رقمية
        $phone = preg_replace('/\D+/', '', $phone);
        $phoneCode = preg_replace('/\D+/', '', $phoneCode);

        // إذا الرقم يبدأ بكود الدولة، لا تغيّر
        if (Str::startsWith($phone, $phoneCode)) {
            return $phone;
        }

        return $phoneCode . $phone;
    }
}
