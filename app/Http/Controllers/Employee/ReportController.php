<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Location;
use App\Models\SeverityLevel;
use App\Models\ReportStatus;
use App\Models\ReportAttachment;
use App\Models\ReportTracking;
use App\Models\User;
use App\Models\Setting;
use App\Notifications\ReportSubmittedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ReportController extends Controller
{
    /**
     * Display a listing of employee's reports.
     */
    public function index(Request $request)
    {
        $employee = auth('employee')->user();

        $query = Report::with([ 'location', 'severityLevel', 'status'])
            ->where('employee_id', $employee->id);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('report_number', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }


        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->filled('severity_level_id')) {
            $query->where('severity_level_id', $request->severity_level_id);
        }

        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('report_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('report_date', '<=', $request->end_date);
        }

        $reports = $query->latest()->paginate(15);

        // Get filter options
        $locations = Location::where('status', 1)->get();
        $severityLevels = SeverityLevel::ordered()->get();
        $reportStatuses = ReportStatus::all();

        return view('Employee.reports.index', compact('reports',  'locations', 'severityLevels', 'reportStatuses'));
    }

    /**
     * Show the form for creating a new report.
     */
    public function create()
    {

        $locations = Location::where('status', 1)->get();
        $severityLevels = SeverityLevel::ordered()->get();

        return view('Employee.reports.create', compact( 'locations', 'severityLevels'));
    }

    /**
     * Store a newly created report.
     */
    public function store(Request $request)
    {
        $employee = auth('employee')->user();

        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'severity_level_id' => 'required|exists:severity_levels,id',
            'report_date' => 'required|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'short_description' => 'required|string',
            'map_url' => 'nullable|url',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp3,wav,ogg,mp4,webm|max:10240',
            'captured_images' => 'nullable|array',
            'captured_images.*' => 'nullable|string',
            'voice_recording' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Get the first status as default (usually "Received")
            $firstStatus = ReportStatus::first();

            $validated['employee_id'] = $employee->id;
            $validated['status_id'] = $firstStatus->id;
            $validated['is_public'] = 0;

            // Create the report
            $report = Report::create($validated);

            $attachmentCount = 0;

            // Handle regular file uploads
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $fileType = 'other';
                    $mimeType = $file->getMimeType();

                    if (str_starts_with($mimeType, 'image/')) {
                        $fileType = 'image';
                    } elseif (str_starts_with($mimeType, 'audio/')) {
                        $fileType = 'audio';
                    }

                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = "uploads/reports/{$report->id}/attachments/";
                    $fileSize = $file->getSize() / 1048576; // Convert to MB

                    // Upload to local storage
                    $file->move(public_path($path), $fileName);
                    $fileUrl = $path . $fileName;

                    ReportAttachment::create([
                        'report_id' => $report->id,
                        'file_path' => $fileUrl,
                        'file_type' => $fileType,
                        'name' => $file->getClientOriginalName(),
                        'size' => $fileSize,
                    ]);

                    $attachmentCount++;
                }
            }

            // Handle captured images (base64)
            if ($request->has('captured_images')) {
                foreach ($request->captured_images as $index => $base64Image) {
                    if (!empty($base64Image)) {
                        // Extract image data from base64
                        $imageData = explode(',', $base64Image);
                        $imageContent = base64_decode(end($imageData));

                        $fileName = time() . '_captured_' . ($index + 1) . '.jpg';
                        $path = "uploads/reports/{$report->id}/attachments/";
                        $fileSize = strlen($imageContent) / 1048576; // Convert to MB

                        // Upload to local storage
                        if (!file_exists(public_path($path))) {
                            mkdir(public_path($path), 0755, true);
                        }
                        file_put_contents(public_path($path . $fileName), $imageContent);
                        $fileUrl = $path . $fileName;

                        ReportAttachment::create([
                            'report_id' => $report->id,
                            'file_path' => $fileUrl,
                            'file_type' => 'image',
                            'name' => $fileName,
                            'size' => $fileSize,
                        ]);

                        $attachmentCount++;
                    }
                }
            }

            // Handle voice recording (base64)
            if ($request->has('voice_recording') && !empty($request->voice_recording)) {
                $audioData = explode(',', $request->voice_recording);
                $audioContent = base64_decode(end($audioData));

                $fileName = time() . '_voice_recording.webm';
                $path = "uploads/reports/{$report->id}/attachments/";
                $fileSize = strlen($audioContent) / 1048576; // Convert to MB

                // Upload to local storage
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0755, true);
                }
                file_put_contents(public_path($path . $fileName), $audioContent);
                $fileUrl = $path . $fileName;

                ReportAttachment::create([
                    'report_id' => $report->id,
                    'file_path' => $fileUrl,
                    'file_type' => 'audio',
                    'name' => $fileName,
                    'size' => $fileSize,
                ]);

                $attachmentCount++;
            }

            if ($attachmentCount > 0) {
                $report->update(['attachments_count' => $attachmentCount]);
            }

            // Create initial tracking record
            ReportTracking::create([
                'report_id' => $report->id,
                'status_id' => $firstStatus->id,
                'comment' => 'تم إنشاء البلاغ',
                'changed_by_employee_id' => $employee->id,
                'created_at' => now(),
            ]);

            // Send notification to admin email from settings
            $report->load(['employee', 'location', 'severityLevel', 'status']);
            $settings = Setting::first();
            if ($settings && $settings->email) {
                Notification::route('mail', $settings->email)
                    ->notify(new ReportSubmittedNotification($report));
            }

            // Also save notification to database for admin users
            $adminUsers = User::all();
            Notification::send($adminUsers, new ReportSubmittedNotification($report));

            DB::commit();

            toast(__('back.report_created_successfully'), 'success');
            return redirect()->route('employee.index');

        } catch (\Exception $e) {
            DB::rollBack();
            toast(__('back.error_occurred') . ': ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    /**
     * Display the specified report.
     */
    public function show(Report $report)
    {
        $employee = auth('employee')->user();

        // Ensure employee can only view their own reports
        if ($report->employee_id !== $employee->id) {
            abort(403);
        }

        $report->load([
            'location',
            'severityLevel',
            'status',
            'attachments',
            'trackings.status',
            'trackings.changedByAdmin',
            'trackings.changedByEmployee',
            'messages.senderAdmin',
            'messages.senderEmployee'
        ]);

        return view('Employee.reports.show', compact('report'));
    }

    /**
     * Send a message to the report.
     */
    public function sendMessage(Request $request, Report $report)
    {
        $employee = auth('employee')->user();

        // Ensure employee can only message their own reports
        if ($report->employee_id !== $employee->id) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = $report->messages()->create([
            'message' => $request->message,
            'sender_admin_id' => null,
            'sender_employee_id' => $employee->id,
        ]);

        // Send notification to all admins
        $senderName = app()->getLocale() == 'ar' ? $employee->name_ar : $employee->name_en;
        $admins = \App\Models\User::all();
        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\NewMessageNotification($report, $message, $senderName));
        }

        toast(trans('back.message_sent_successfully'), 'success');
        return redirect()->back();
    }
}