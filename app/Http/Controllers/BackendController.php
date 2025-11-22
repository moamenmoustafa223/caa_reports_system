<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportStatus;
use App\Models\SeverityLevel;
use App\Models\HR\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function index(Request $request)
    {
        // Report statistics
        $total_reports = Report::count();
        $reports_today = Report::whereDate('created_at', today())->count();
        $reports_this_week = Report::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $reports_this_month = Report::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        // Reports by status
        $reportsByStatus = ReportStatus::withCount('reports')->get();

        // Reports by severity level
        $reportsBySeverity = SeverityLevel::withCount('reports')->ordered()->get();

        // Recent reports
        $recent_reports = Report::with(['employee', 'status', 'location', 'severityLevel'])
            ->latest()
            ->take(5)
            ->get();

        // Get unread notifications with report data
        $notifications = auth()->user()->unreadNotifications()
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($notification) {
                $reportId = $notification->data['report_id'] ?? null;
                if ($reportId) {
                    $report = Report::with('severityLevel')->find($reportId);
                    $notification->report = $report;
                }
                return $notification;
            });

        return view('backend.dashboard', compact(
            'total_reports',
            'reports_today',
            'reports_this_week',
            'reports_this_month',
            'reportsByStatus',
            'reportsBySeverity',
            'recent_reports',
            'notifications'
        ));
    }


    public function show_notification_all()
    {
        return view('backend.show_notification_all');
    }

    // مسح جميع الإشعارات
    public function markAsRead_all(Request $request)
    {
        Auth::user()->unreadNotifications->markAsRead();
        toast('تم مسح جميع الإشعارات بنجاح بنجاح', 'success');
        return redirect()->back();
    }
    // مسح إشعار واحد فقط
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        toast('تم مسح الاشعار بنجاح بنجاح', 'success');
        return redirect()->back();
    }

    // Get notification count for polling
    public function getNotificationCount()
    {
        return response()->json([
            'count' => Auth::user()->unreadNotifications->count()
        ]);
    }
    // عرض التقارير الاجمالية
    public function show_reports_all()
    {

        // الموارد البشرية
        // Employee Count
        $employee_count = DB::table('employees')->count();
        return view(
            'backend.show_reports_all',
            compact(
                'employee_count',
            )
        );
    }
    // تقرير الكل بين تاريخين
    public function reports_all_between_two_dates(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d');


        // الموارد البشرية
        // Employee Count
        $employee_count = DB::table('employees')
            ->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)
            ->count();

        return view(
            'backend.reports_all_between_two_dates',
            compact(
                'start_date',
                'end_date',
                'employee_count',
                
            )
        );
    }

}
