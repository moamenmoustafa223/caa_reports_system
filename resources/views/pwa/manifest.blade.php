@php
    $setting = \App\Models\Setting::first();
    $locale = app()->getLocale();
    
    $companyName = $locale === 'ar' 
        ? ($setting->company_name_ar ?? "نظام الإخطارات")
        : ($setting->company_name_en ?? "Ikhtaar Reporting System");
    
    $description = $locale === 'ar'
        ? "{$companyName} - نظام الإخطارات"
        : "{$companyName} - Ikhtaar Reporting System";
@endphp
{
    "name": "{{ $companyName }}",
    "short_name": "{{ substr($companyName, 0, 12) }}",
    "description": "{{ $description }}",
    "start_url": "/",
    "id": "/",
    "display": "standalone",
    "background_color": "#ffffff",
    "theme_color": "#262761",
    "orientation": "any",
    "icons": [
        {
            "src": "/images/icons/icon-72x72.png",
            "type": "image/png",
            "sizes": "72x72",
            "purpose": "any"
        },
        {
            "src": "/images/icons/icon-96x96.png",
            "type": "image/png",
            "sizes": "96x96",
            "purpose": "any"
        },
        {
            "src": "/images/icons/icon-128x128.png",
            "type": "image/png",
            "sizes": "128x128",
            "purpose": "any"
        },
        {
            "src": "/images/icons/icon-144x144.png",
            "type": "image/png",
            "sizes": "144x144",
            "purpose": "any"
        },
        {
            "src": "/images/icons/icon-152x152.png",
            "type": "image/png",
            "sizes": "152x152",
            "purpose": "any"
        },
        {
            "src": "/images/icons/icon-192x192.png",
            "type": "image/png",
            "sizes": "192x192",
            "purpose": "any"
        },
        {
            "src": "/images/icons/icon-384x384.png",
            "type": "image/png",
            "sizes": "384x384",
            "purpose": "any"
        },
        {
            "src": "/images/icons/icon-512x512.png",
            "type": "image/png",
            "sizes": "512x512",
            "purpose": "any"
        },
        {
            "src": "/images/icons/icon-192x192.png",
            "type": "image/png",
            "sizes": "192x192",
            "purpose": "maskable"
        },
        {
            "src": "/images/icons/icon-512x512.png",
            "type": "image/png",
            "sizes": "512x512",
            "purpose": "maskable"
        }
    ],
    "screenshots": [
        {
            "src": "/images/screenshots/screenshot-wide.png",
            "sizes": "1280x720",
            "type": "image/png",
            "form_factor": "wide",
            "label": "Dashboard"
        },
        {
            "src": "/images/screenshots/screenshot-mobile.png",
            "sizes": "540x720",
            "type": "image/png",
            "form_factor": "narrow",
            "label": "Mobile View"
        }
    ],
    "shortcuts": [
        {
            "name": "Dashboard",
            "short_name": "Dashboard",
            "description": "Go to Dashboard",
            "url": "/dashboard",
            "icons": [
                {
                    "src": "/images/icons/icon-96x96.png",
                    "sizes": "96x96"
                }
            ]
        }
    ]
}
