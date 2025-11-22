# Reporting System - Complete Implementation Guide

## Overview
This guide provides a complete implementation of a Reporting System for your Laravel project with admin and employee interfaces.

---

## 1. Files Created

### 1.1 Migrations (7 files)
- `database/migrations/2024_01_01_000001_create_sections_table.php`
- `database/migrations/2024_01_01_000002_create_locations_table.php`
- `database/migrations/2024_01_01_000003_create_severity_levels_table.php`
- `database/migrations/2024_01_01_000004_create_report_statuses_table.php`
- `database/migrations/2024_01_01_000005_create_reports_table.php`
- `database/migrations/2024_01_01_000006_create_report_attachments_table.php`
- `database/migrations/2024_01_01_000007_create_report_trackings_table.php`

### 1.2 Models (7 files)
- `app/Models/Section.php`
- `app/Models/Location.php`
- `app/Models/SeverityLevel.php`
- `app/Models/ReportStatus.php`
- `app/Models/Report.php`
- `app/Models/ReportAttachment.php`
- `app/Models/ReportTracking.php`

### 1.3 Controllers (6 files)
**Admin Controllers:**
- `app/Http/Controllers/SectionController.php`
- `app/Http/Controllers/LocationController.php`
- `app/Http/Controllers/SeverityLevelController.php`
- `app/Http/Controllers/ReportStatusController.php`
- `app/Http/Controllers/ReportController.php`
- `app/Http/Controllers/ReportAttachmentController.php`

**Employee Controller:**
- `app/Http/Controllers/Employee/ReportController.php`

### 1.4 Views Created
**Admin Views - Sections:**
- `resources/views/backend/pages/sections/index.blade.php`
- `resources/views/backend/pages/sections/add.blade.php`
- `resources/views/backend/pages/sections/edit.blade.php`
- `resources/views/backend/pages/sections/show.blade.php`
- `resources/views/backend/pages/sections/delete.blade.php`

**Admin Views - Reports:**
- `resources/views/backend/pages/reports/index.blade.php`
- `resources/views/backend/pages/reports/add.blade.php`
- `resources/views/backend/pages/reports/show.blade.php`
- `resources/views/backend/pages/reports/delete.blade.php`

### 1.5 Seeders (4 files)
- `database/seeders/SectionSeeder.php`
- `database/seeders/LocationSeeder.php`
- `database/seeders/SeverityLevelSeeder.php`
- `database/seeders/ReportStatusSeeder.php`

### 1.6 Updated Files
- `database/seeders/PermissionTableSeeder.php` (Updated with new permissions)

---

## 2. Routes to Add

Add these routes to your `routes/web.php` file:

```php
<?php

// Admin Routes - Reporting System
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {

    // Sections
    Route::resource('sections', \App\Http\Controllers\SectionController::class);

    // Locations
    Route::resource('locations', \App\Http\Controllers\LocationController::class);

    // Severity Levels
    Route::resource('severity_levels', \App\Http\Controllers\SeverityLevelController::class);

    // Report Statuses
    Route::resource('report_statuses', \App\Http\Controllers\ReportStatusController::class);

    // Reports
    Route::get('reports/export', [\App\Http\Controllers\ReportController::class, 'export'])->name('reports.export');
    Route::post('reports/{report}/change-status', [\App\Http\Controllers\ReportController::class, 'changeStatus'])->name('reports.change_status');
    Route::resource('reports', \App\Http\Controllers\ReportController::class);

    // Report Attachments
    Route::get('attachments/{attachment}/download', [\App\Http\Controllers\ReportAttachmentController::class, 'download'])->name('attachments.download');
    Route::delete('attachments/{attachment}', [\App\Http\Controllers\ReportAttachmentController::class, 'destroy'])->name('attachments.destroy');
});

// Employee Routes - Report Submission
Route::group(['prefix' => 'employee/reports', 'middleware' => ['auth:employee']], function () {
    Route::get('/', [\App\Http\Controllers\Employee\ReportController::class, 'index'])->name('employee.reports.index');
    Route::get('create', [\App\Http\Controllers\Employee\ReportController::class, 'create'])->name('employee.reports.create');
    Route::post('/', [\App\Http\Controllers\Employee\ReportController::class, 'store'])->name('employee.reports.store');
    Route::get('{report}', [\App\Http\Controllers\Employee\ReportController::class, 'show'])->name('employee.reports.show');
});
```

---

## 3. Sidenav Menu Update

Add this to your `resources/views/backend/layouts/sidenav.blade.php` (or wherever your sidebar is):

```blade
<!-- Reporting System Menu -->
@canany(['sections', 'locations', 'severity_levels', 'report_statuses', 'reports', 'report_trackings'])
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#reportingSystemMenu" aria-expanded="false">
        <i class="ti ti-report"></i>
        <span>{{ __('back.reporting_system') }}</span>
        <i class="ti ti-chevron-down ms-auto"></i>
    </a>
    <div id="reportingSystemMenu" class="collapse" data-bs-parent="#sidenavAccordion">
        <nav class="nav flex-column">
            @can('sections')
            <a class="nav-link" href="{{ route('sections.index') }}">
                <i class="ti ti-category"></i> {{ __('back.sections') }}
            </a>
            @endcan

            @can('locations')
            <a class="nav-link" href="{{ route('locations.index') }}">
                <i class="ti ti-map-pin"></i> {{ __('back.locations') }}
            </a>
            @endcan

            @can('severity_levels')
            <a class="nav-link" href="{{ route('severity_levels.index') }}">
                <i class="ti ti-alert-triangle"></i> {{ __('back.severity_levels') }}
            </a>
            @endcan

            @can('report_statuses')
            <a class="nav-link" href="{{ route('report_statuses.index') }}">
                <i class="ti ti-check"></i> {{ __('back.report_statuses') }}
            </a>
            @endcan

            @can('reports')
            <a class="nav-link" href="{{ route('reports.index') }}">
                <i class="ti ti-file-text"></i> {{ __('back.reports') }}
            </a>
            @endcan
        </nav>
    </div>
</li>
@endcanany
```

---

## 4. Localization Strings

### 4.1 Arabic (`resources/lang/ar/back.php`)

Add these keys to your Arabic language file:

```php
<?php

return [
    // ... existing translations ...

    // Reporting System
    'reporting_system' => 'نظام البلاغات',

    // Sections
    'sections' => 'الأقسام',
    'section' => 'القسم',
    'add_section' => 'إضافة قسم',
    'edit_section' => 'تعديل قسم',
    'delete_section' => 'حذف قسم',
    'show_section' => 'عرض قسم',
    'section_details' => 'تفاصيل القسم',
    'select_section' => 'اختر القسم',

    // Locations
    'locations' => 'المواقع',
    'location' => 'الموقع',
    'add_location' => 'إضافة موقع',
    'edit_location' => 'تعديل موقع',
    'delete_location' => 'حذف موقع',
    'show_location' => 'عرض موقع',
    'location_details' => 'تفاصيل الموقع',
    'select_location' => 'اختر الموقع',

    // Severity Levels
    'severity_levels' => 'مستوى الخطورة',
    'severity_level' => 'مستوى الخطورة',
    'add_severity_level' => 'إضافة مستوى خطورة',
    'edit_severity_level' => 'تعديل مستوى خطورة',
    'delete_severity_level' => 'حذف مستوى خطورة',
    'show_severity_level' => 'عرض مستوى خطورة',
    'severity' => 'الخطورة',
    'select_severity' => 'اختر مستوى الخطورة',
    'level_key' => 'مفتاح المستوى',
    'order' => 'الترتيب',
    'color' => 'اللون',

    // Report Statuses
    'report_statuses' => 'حالات البلاغ',
    'report_status' => 'حالة البلاغ',
    'add_report_status' => 'إضافة حالة',
    'edit_report_status' => 'تعديل حالة',
    'delete_report_status' => 'حذف حالة',
    'show_report_status' => 'عرض حالة',
    'new_status' => 'الحالة الجديدة',
    'change_status' => 'تغيير الحالة',
    'status_changed_successfully' => 'تم تغيير الحالة بنجاح',
    'update_status' => 'تحديث الحالة',

    // Reports
    'reports' => 'البلاغات',
    'report' => 'بلاغ',
    'add_report' => 'إضافة بلاغ',
    'edit_report' => 'تعديل بلاغ',
    'delete_report' => 'حذف بلاغ',
    'show_report' => 'عرض بلاغ',
    'report_details' => 'تفاصيل البلاغ',
    'report_number' => 'رقم البلاغ',
    'report_date' => 'تاريخ البلاغ',
    'report_created_successfully' => 'تم إنشاء البلاغ بنجاح',
    'search_reports' => 'بحث في البلاغات',

    // Report Fields
    'short_description' => 'الوصف المختصر',
    'short_description_ar' => 'الوصف المختصر (عربي)',
    'short_description_en' => 'الوصف المختصر (إنجليزي)',
    'full_description' => 'الوصف الكامل',
    'full_description_ar' => 'الوصف الكامل (عربي)',
    'full_description_en' => 'الوصف الكامل (إنجليزي)',
    'latitude' => 'خط العرض',
    'longitude' => 'خط الطول',
    'coordinates' => 'الإحداثيات',
    'map_url' => 'رابط الخريطة',
    'view_on_map' => 'عرض على الخريطة',
    'is_public' => 'عام',
    'make_public' => 'جعل البلاغ عاماً',

    // Attachments
    'attachments' => 'المرفقات',
    'attachment' => 'مرفق',
    'add_attachment' => 'إضافة مرفق',
    'delete_attachment' => 'حذف مرفق',
    'download' => 'تحميل',
    'accepted_files' => 'الملفات المقبولة',
    'max_size' => 'الحجم الأقصى',
    'all_attachments_will_be_deleted' => 'سيتم حذف جميع المرفقات',

    // Tracking
    'tracking_history' => 'سجل التتبع',
    'report_trackings' => 'تتبع البلاغات',
    'add_tracking' => 'إضافة تتبع',
    'show_tracking' => 'عرض تتبع',
    'no_tracking_history' => 'لا يوجد سجل تتبع',
    'comment_ar' => 'التعليق (عربي)',
    'comment_en' => 'التعليق (إنجليزي)',
    'by' => 'بواسطة',

    // Common
    'name_ar' => 'الاسم (عربي)',
    'name_en' => 'الاسم (إنجليزي)',
    'description_ar' => 'الوصف (عربي)',
    'description_en' => 'الوصف (إنجليزي)',
    'status' => 'الحالة',
    'active' => 'نشط',
    'inactive' => 'غير نشط',
    'employee' => 'الموظف',
    'select_employee' => 'اختر الموظف',
    'date' => 'التاريخ',
    'start_date' => 'تاريخ البداية',
    'end_date' => 'تاريخ النهاية',
    'actions' => 'الإجراءات',
    'save' => 'حفظ',
    'update' => 'تحديث',
    'delete' => 'حذف',
    'cancel' => 'إلغاء',
    'back' => 'رجوع',
    'edit' => 'تعديل',
    'export' => 'تصدير',
    'filter' => 'فلترة',
    'reset' => 'إعادة تعيين',
    'search' => 'بحث',
    'all' => 'الكل',
    'yes' => 'نعم',
    'no' => 'لا',
    'created_at' => 'تاريخ الإنشاء',
    'updated_at' => 'تاريخ التحديث',
    'no_data' => 'لا توجد بيانات',
    'added_successfully' => 'تمت الإضافة بنجاح',
    'updated_successfully' => 'تم التحديث بنجاح',
    'deleted_successfully' => 'تم الحذف بنجاح',
    'delete_confirmation' => 'هل أنت متأكد من الحذف؟',
    'error_occurred' => 'حدث خطأ',
];
```

### 4.2 English (`resources/lang/en/back.php`)

Add these keys to your English language file:

```php
<?php

return [
    // ... existing translations ...

    // Reporting System
    'reporting_system' => 'Reporting System',

    // Sections
    'sections' => 'Sections',
    'section' => 'Section',
    'add_section' => 'Add Section',
    'edit_section' => 'Edit Section',
    'delete_section' => 'Delete Section',
    'show_section' => 'Show Section',
    'section_details' => 'Section Details',
    'select_section' => 'Select Section',

    // Locations
    'locations' => 'Locations',
    'location' => 'Location',
    'add_location' => 'Add Location',
    'edit_location' => 'Edit Location',
    'delete_location' => 'Delete Location',
    'show_location' => 'Show Location',
    'location_details' => 'Location Details',
    'select_location' => 'Select Location',

    // Severity Levels
    'severity_levels' => 'Severity Levels',
    'severity_level' => 'Severity Level',
    'add_severity_level' => 'Add Severity Level',
    'edit_severity_level' => 'Edit Severity Level',
    'delete_severity_level' => 'Delete Severity Level',
    'show_severity_level' => 'Show Severity Level',
    'severity' => 'Severity',
    'select_severity' => 'Select Severity',
    'level_key' => 'Level Key',
    'order' => 'Order',
    'color' => 'Color',

    // Report Statuses
    'report_statuses' => 'Report Statuses',
    'report_status' => 'Report Status',
    'add_report_status' => 'Add Status',
    'edit_report_status' => 'Edit Status',
    'delete_report_status' => 'Delete Status',
    'show_report_status' => 'Show Status',
    'new_status' => 'New Status',
    'change_status' => 'Change Status',
    'status_changed_successfully' => 'Status changed successfully',
    'update_status' => 'Update Status',

    // Reports
    'reports' => 'Reports',
    'report' => 'Report',
    'add_report' => 'Add Report',
    'edit_report' => 'Edit Report',
    'delete_report' => 'Delete Report',
    'show_report' => 'Show Report',
    'report_details' => 'Report Details',
    'report_number' => 'Report Number',
    'report_date' => 'Report Date',
    'report_created_successfully' => 'Report created successfully',
    'search_reports' => 'Search Reports',

    // Report Fields
    'short_description' => 'Short Description',
    'short_description_ar' => 'Short Description (Arabic)',
    'short_description_en' => 'Short Description (English)',
    'full_description' => 'Full Description',
    'full_description_ar' => 'Full Description (Arabic)',
    'full_description_en' => 'Full Description (English)',
    'latitude' => 'Latitude',
    'longitude' => 'Longitude',
    'coordinates' => 'Coordinates',
    'map_url' => 'Map URL',
    'view_on_map' => 'View on Map',
    'is_public' => 'Public',
    'make_public' => 'Make Report Public',

    // Attachments
    'attachments' => 'Attachments',
    'attachment' => 'Attachment',
    'add_attachment' => 'Add Attachment',
    'delete_attachment' => 'Delete Attachment',
    'download' => 'Download',
    'accepted_files' => 'Accepted Files',
    'max_size' => 'Max Size',
    'all_attachments_will_be_deleted' => 'All attachments will be deleted',

    // Tracking
    'tracking_history' => 'Tracking History',
    'report_trackings' => 'Report Trackings',
    'add_tracking' => 'Add Tracking',
    'show_tracking' => 'Show Tracking',
    'no_tracking_history' => 'No tracking history',
    'comment_ar' => 'Comment (Arabic)',
    'comment_en' => 'Comment (English)',
    'by' => 'By',

    // Common
    'name_ar' => 'Name (Arabic)',
    'name_en' => 'Name (English)',
    'description_ar' => 'Description (Arabic)',
    'description_en' => 'Description (English)',
    'status' => 'Status',
    'active' => 'Active',
    'inactive' => 'Inactive',
    'employee' => 'Employee',
    'select_employee' => 'Select Employee',
    'date' => 'Date',
    'start_date' => 'Start Date',
    'end_date' => 'End Date',
    'actions' => 'Actions',
    'save' => 'Save',
    'update' => 'Update',
    'delete' => 'Delete',
    'cancel' => 'Cancel',
    'back' => 'Back',
    'edit' => 'Edit',
    'export' => 'Export',
    'filter' => 'Filter',
    'reset' => 'Reset',
    'search' => 'Search',
    'all' => 'All',
    'yes' => 'Yes',
    'no' => 'No',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
    'no_data' => 'No Data',
    'added_successfully' => 'Added successfully',
    'updated_successfully' => 'Updated successfully',
    'deleted_successfully' => 'Deleted successfully',
    'delete_confirmation' => 'Are you sure you want to delete?',
    'error_occurred' => 'An error occurred',
];
```

---

## 5. Views That Need to Be Created (Using Section Views as Template)

You need to create similar views for the following modules by copying the Section views and adjusting field names:

### 5.1 Locations Views
Copy all 5 section view files and create:
- `resources/views/backend/pages/locations/index.blade.php`
- `resources/views/backend/pages/locations/add.blade.php`
- `resources/views/backend/pages/locations/edit.blade.php`
- `resources/views/backend/pages/locations/show.blade.php`
- `resources/views/backend/pages/locations/delete.blade.php`

**Changes needed:** Same structure as sections (name_ar, name_en, status fields)

### 5.2 Severity Levels Views
- `resources/views/backend/pages/severity_levels/index.blade.php`
- `resources/views/backend/pages/severity_levels/add.blade.php`
- `resources/views/backend/pages/severity_levels/edit.blade.php`
- `resources/views/backend/pages/severity_levels/show.blade.php`
- `resources/views/backend/pages/severity_levels/delete.blade.php`

**Additional fields to add:**
- `level_key` (text input, unique)
- `order` (number input)
- `color` (color picker input: `<input type="color" ...>`)

### 5.3 Report Statuses Views
- `resources/views/backend/pages/report_statuses/index.blade.php`
- `resources/views/backend/pages/report_statuses/add.blade.php`
- `resources/views/backend/pages/report_statuses/edit.blade.php`
- `resources/views/backend/pages/report_statuses/show.blade.php`
- `resources/views/backend/pages/report_statuses/delete.blade.php`

**Additional fields to add:**
- `color` (color picker)
- `description_ar` (textarea)
- `description_en` (textarea)

### 5.4 Reports Edit View
- `resources/views/backend/pages/reports/edit.blade.php`

**Instructions:** Copy `add.blade.php` and:
1. Change form action to `route('reports.update', $report->id)`
2. Add `@method('PUT')` after `@csrf`
3. Add `old('field', $report->field)` for all values
4. Add current status field (select dropdown)
5. Display existing attachments with delete option

### 5.5 Employee Views (Mobile-Friendly)
Create these views under `resources/views/employee/reports/`:
- `index.blade.php` - List employee's own reports
- `create.blade.php` - Submit new report (no employee selector, auto-filled)
- `show.blade.php` - View report details with tracking (read-only)

**Layout:** Use a simpler layout or create `resources/views/employee/layouts/master.blade.php` extending your main layout with mobile-optimized styles.

---

## 6. Installation and Setup Steps

### Step 1: Run Migrations
```bash
php artisan migrate
```

### Step 2: Run Seeders
```bash
php artisan db:seed --class=SectionSeeder
php artisan db:seed --class=LocationSeeder
php artisan db:seed --class=SeverityLevelSeeder
php artisan db:seed --class=ReportStatusSeeder
php artisan db:seed --class=PermissionTableSeeder
```

### Step 3: Create Storage Link (if not exists)
```bash
php artisan storage:link
```

### Step 4: Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Step 5: Assign Permissions to Admin Role
Go to your admin panel and assign the new reporting system permissions to the admin role or create a new role for report managers.

---

## 7. Third-Party Packages (Optional)

For Excel export functionality, consider installing:

```bash
composer require maatwebsite/excel
```

Then update the `export()` method in `ReportController` to use Laravel Excel package for better formatting.

---

## 8. Additional Features to Implement

### 8.1 Map Integration (Google Maps or Leaflet)
In the report add/edit forms, integrate a map picker:

```html
<!-- Add in the form -->
<div id="map" style="height: 400px; width: 100%;"></div>

<script>
// Initialize map and allow clicking to set coordinates
let map = L.map('map').setView([17.038954, 54.095187], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

let marker;
map.on('click', function(e) {
    if (marker) {
        map.removeLayer(marker);
    }
    marker = L.marker(e.latlng).addTo(map);
    $('#latitude').val(e.latlng.lat);
    $('#longitude').val(e.latlng.lng);
});
</script>
```

### 8.2 Real-Time Notifications
Consider adding notifications when:
- A new report is submitted (notify admins)
- Report status changes (notify employee)

Use Laravel's notification system or Pusher for real-time updates.

### 8.3 Email Notifications
Add email notifications in the `ReportController@store` and `changeStatus` methods:

```php
// After creating report
Mail::to($admins)->send(new NewReportNotification($report));

// After status change
Mail::to($report->employee->email)->send(new ReportStatusChanged($report));
```

---

## 9. Testing Checklist

- [ ] Admin can create sections, locations, severity levels, report statuses
- [ ] Admin can create reports with attachments
- [ ] File uploads work (images and audio files)
- [ ] Report number auto-generates correctly
- [ ] Filters work on reports index page
- [ ] Export to CSV works
- [ ] Admin can change report status
- [ ] Tracking history displays correctly
- [ ] Employee can submit reports
- [ ] Employee can view their own reports
- [ ] Employee cannot view other employees' reports
- [ ] Permissions restrict access correctly
- [ ] Localization works for both Arabic and English
- [ ] Map coordinates save and display correctly
- [ ] Attachments can be downloaded
- [ ] Delete modals work for all modules
- [ ] Select2 dropdowns work properly

---

## 10. File Structure Summary

```
app/
├── Http/
│   └── Controllers/
│       ├── SectionController.php
│       ├── LocationController.php
│       ├── SeverityLevelController.php
│       ├── ReportStatusController.php
│       ├── ReportController.php
│       ├── ReportAttachmentController.php
│       └── Employee/
│           └── ReportController.php
└── Models/
    ├── Section.php
    ├── Location.php
    ├── SeverityLevel.php
    ├── ReportStatus.php
    ├── Report.php
    ├── ReportAttachment.php
    └── ReportTracking.php

database/
├── migrations/
│   ├── 2024_01_01_000001_create_sections_table.php
│   ├── 2024_01_01_000002_create_locations_table.php
│   ├── 2024_01_01_000003_create_severity_levels_table.php
│   ├── 2024_01_01_000004_create_report_statuses_table.php
│   ├── 2024_01_01_000005_create_reports_table.php
│   ├── 2024_01_01_000006_create_report_attachments_table.php
│   └── 2024_01_01_000007_create_report_trackings_table.php
└── seeders/
    ├── SectionSeeder.php
    ├── LocationSeeder.php
    ├── SeverityLevelSeeder.php
    ├── ReportStatusSeeder.php
    └── PermissionTableSeeder.php (updated)

resources/
├── lang/
│   ├── ar/
│   │   └── back.php (updated)
│   └── en/
│       └── back.php (updated)
└── views/
    ├── backend/
    │   ├── layouts/
    │   │   └── sidenav.blade.php (to be updated)
    │   └── pages/
    │       ├── sections/
    │       │   ├── index.blade.php
    │       │   ├── add.blade.php
    │       │   ├── edit.blade.php
    │       │   ├── show.blade.php
    │       │   └── delete.blade.php
    │       ├── locations/ (to be created - copy sections)
    │       ├── severity_levels/ (to be created - copy sections + extra fields)
    │       ├── report_statuses/ (to be created - copy sections + extra fields)
    │       └── reports/
    │           ├── index.blade.php
    │           ├── add.blade.php
    │           ├── edit.blade.php (to be created)
    │           ├── show.blade.php
    │           └── delete.blade.php
    └── employee/
        └── reports/
            ├── index.blade.php (to be created)
            ├── create.blade.php (to be created)
            └── show.blade.php (to be created)

routes/
└── web.php (to be updated with routes above)
```

---

## 11. Quick Start Commands

```bash
# Run all migrations
php artisan migrate

# Seed the database
php artisan db:seed --class=SectionSeeder
php artisan db:seed --class=LocationSeeder
php artisan db:seed --class=SeverityLevelSeeder
php artisan db:seed --class=ReportStatusSeeder
php artisan db:seed --class=PermissionTableSeeder

# Create storage link
php artisan storage:link

# Clear all cache
php artisan optimize:clear
```

---

## 12. Support and Next Steps

1. **Create remaining views** using the section views as templates
2. **Test all functionality** using the checklist in section 9
3. **Add map integration** for better location picking
4. **Implement email notifications** for report updates
5. **Consider adding dashboard widgets** showing report statistics
6. **Add mobile app** if needed (use Laravel Sanctum for API authentication)

---

**End of Implementation Guide**

For questions or issues, refer to Laravel documentation or contact your development team.
