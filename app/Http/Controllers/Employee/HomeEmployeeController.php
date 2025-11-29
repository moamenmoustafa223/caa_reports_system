<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\SafetyTip;
use Illuminate\Support\Facades\Auth;

class HomeEmployeeController extends Controller
{
    public function index()
    {
        $employee = Auth::guard('employee')->user();
        $safetyTips = SafetyTip::active()->ordered()->get();
        return view('Employee.index', compact('employee', 'safetyTips'));
    }

    /**
     * Get notification count for AJAX polling
     */
    public function getNotificationCount()
    {
        $employee = Auth::guard('employee')->user();
        $unreadCount = $employee->unreadNotifications->count();

        return response()->json([
            'count' => $unreadCount,
            'count_display' => $unreadCount > 10 ? '10+' : $unreadCount
        ]);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        $employee = Auth::guard('employee')->user();
        $notification = $employee->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    /**
     * Mark all notifications as read
     */
    public function markAsReadAll()
    {
        $employee = Auth::guard('employee')->user();
        $employee->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Get unread notifications for AJAX
     */
    public function getNotifications()
    {
        $employee = Auth::guard('employee')->user();
        $notifications = $employee->unreadNotifications;

        $notificationsHtml = view('Employee.partials.notifications', compact('notifications'))->render();

        return response()->json([
            'count' => $notifications->count(),
            'count_display' => $notifications->count() > 10 ? '10+' : $notifications->count(),
            'html' => $notificationsHtml
        ]);
    }
}
