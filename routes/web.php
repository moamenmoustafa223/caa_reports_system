<?php


use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Employee\HomeEmployeeController;
use App\Http\Controllers\Employee\MessageController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HR\CategoryEmployeesController;
use App\Http\Controllers\HR\EmployeeController;
use App\Http\Controllers\HR\EmployeesImageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SeverityLevelController;
use App\Http\Controllers\ReportStatusController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportAttachmentController;
use App\Http\Controllers\SafetyTipController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
*/

// PWA Routes
Route::get('/offline', function () {
    return view('pwa.offline');
})->name('offline');

Route::get('/manifest.json', function () {
    return response()->file(public_path('manifest.json'), [
        'Content-Type' => 'application/manifest+json'
    ]);
});

Route::get('/serviceworker.js', function () {
    return response()->file(public_path('serviceworker.js'), [
        'Content-Type' => 'application/javascript'
    ]);
});



// Login ====================================================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::resource('/', FrontendController::class);
        Route::get('admin/login', [FrontendController::class, 'login_admin'])->name('login_admin');
        Route::get('login_employee', [FrontendController::class, 'login_employee'])->name('login_employee');
        require __DIR__ . '/auth.php';
    }
);

// Backend ====================================================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']
    ],
    function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('Setting', SettingController::class);
        Route::resource('dashboard', BackendController::class);
        // عرض جميع الاشعارات
        Route::get('/show_notification_all', [BackendController::class, 'show_notification_all'])->name('show_notification_all');
        Route::get('/all_messages', [BackendController::class, 'all_messages'])->name('all_messages');
        Route::put('/edit_messages_status/{id}', [BackendController::class, 'edit_messages_status'])->name('edit_messages_status');
        Route::put('/reply_message/{id}', [BackendController::class, 'reply_message'])->name('reply_message');

        // مسح الاشعارات
        Route::get('/markAsRead_all', [BackendController::class, 'markAsRead_all'])->name('markAsRead_all');
        Route::get('/markAsRead/{id}', [BackendController::class, 'markAsRead'])->name('markAsRead');
        Route::get('/notifications/count', [BackendController::class, 'getNotificationCount'])->name('notifications.count');


        // تقارير الكل
        Route::get('/reports_all_between_two_dates/', [BackendController::class, 'reports_all_between_two_dates'])->name('reports_all_between_two_dates');
        Route::post('/reports_all_between_two_dates/', [BackendController::class, 'reports_all_between_two_dates'])->name('reports_all_between_two_dates_post');

        // عرض التقرير الاجمالية
        Route::get('/show_reports_all', [BackendController::class, 'show_reports_all'])->name('show_reports_all');


        //======================================================================
        // مرفقات الطلاب
        Route::resource('attachments', AttachmentController::class);


        // الموارد البشرية =========================================================================================


        Route::resource('CategoryEmployees', CategoryEmployeesController::class);
        Route::resource('Employees', EmployeeController::class);
        Route::resource('EmployeesImages', EmployeesImageController::class);

        // مسح الاشعارات
        Route::get('/markAsRead_all', [BackendController::class, 'markAsRead_all'])->name('markAsRead_all');
        Route::get('/markAsRead/{id}', [BackendController::class, 'markAsRead'])->name('markAsRead');

        // تقرير الموارد البشرية بين تاريخين
        Route::get('reports_hr_between_two_dates', [BackendController::class, 'reports_hr_between_two_dates'])->name('reports_hr_between_two_dates');
        Route::post('reports_hr_between_two_dates', [BackendController::class, 'reports_hr_between_two_dates'])->name('reports_hr_between_two_dates');

        Route::resource('locations', LocationController::class);
        Route::resource('severity_levels', SeverityLevelController::class);
        Route::resource('report_statuses', ReportStatusController::class);
        Route::resource('safety_tips', SafetyTipController::class);

        // Reports
        Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
        Route::post('reports/{report}/change-status', [ReportController::class, 'changeStatus'])->name('reports.change_status');
        Route::resource('reports', ReportController::class);

        // Report Attachments
        Route::get('attachments/{attachment}/download', [ReportAttachmentController::class, 'download'])->name('attachments.download');
        Route::delete('report-attachments/{attachment}', [ReportAttachmentController::class, 'destroy'])->name('report_attachments.destroy');
    }
);



// Employee ====================================================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/employee',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:employee']
    ],
    function () {
        Route::get('/', [HomeEmployeeController::class, 'index'])->name('employee.index');
        Route::get('my-info', [HomeEmployeeController::class, 'myInfo'])->name('employee.my_info');
        Route::resource('Messages', MessageController::class);

        // Employee profile
        Route::get('profile', [\App\Http\Controllers\Employee\EmployeeProfileController::class, 'show'])->name('employee.profile.show');
        Route::post('profile', [\App\Http\Controllers\Employee\EmployeeProfileController::class, 'update'])->name('employee.profile.update');

        // Employee Reports
        Route::get('my-reports', [\App\Http\Controllers\Employee\ReportController::class, 'index'])->name('employee.reports.index');
        Route::get('my-reports/create', [\App\Http\Controllers\Employee\ReportController::class, 'create'])->name('employee.reports.create');
        Route::post('my-reports', [\App\Http\Controllers\Employee\ReportController::class, 'store'])->name('employee.reports.store');
        Route::get('my-reports/{report}', [\App\Http\Controllers\Employee\ReportController::class, 'show'])->name('employee.reports.show');
    }
);
