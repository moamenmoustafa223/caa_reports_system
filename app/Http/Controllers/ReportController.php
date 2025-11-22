<?php

namespace App\Http\Controllers;

use App\Models\Report;

use App\Models\Location;
use App\Models\SeverityLevel;
use App\Models\ReportStatus;
use App\Models\HR\Employee;
use App\Models\ReportAttachment;
use App\Models\ReportTracking;
use App\Notifications\ReportUpdatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource with filters.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can('reports')) {
            abort(403);
        }

        $query = Report::with(['employee', 'location', 'severityLevel', 'status']);


        if ($request->filled('status_id')) {
            $query->byStatus($request->status_id);
        }

        if ($request->filled('severity_level_id')) {
            $query->bySeverity($request->severity_level_id);
        }

        if ($request->filled('location_id')) {
            $query->byLocation($request->location_id);
        }

        if ($request->filled('employee_id')) {
            $query->byEmployee($request->employee_id);
        }

        if ($request->filled('start_date') || $request->filled('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $reports = $query->latest()->paginate(15)->withQueryString();

        // Get filter data
        $locations = Location::where('status', 1)->get();
        $severityLevels = SeverityLevel::ordered()->get();
        $reportStatuses = ReportStatus::all();
        $employees = Employee::where('status', 1)->get();

        return view('backend.pages.reports.index', compact(
            'reports',
            'locations',
            'severityLevels',
            'reportStatuses',
            'employees'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('add_report')) {
            abort(403);
        }

        $locations = Location::where('status', 1)->get();
        $severityLevels = SeverityLevel::ordered()->get();
        $employees = Employee::where('status', 1)->get();

        return view('backend.pages.reports.add', compact(
            'locations',
            'severityLevels',
            'employees'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('add_report')) {
            abort(403);
        }

        $validated = $request->validate([
            'employee_id' => 'nullable|exists:employees,id',
            
            'location_id' => 'required|exists:locations,id',
            'severity_level_id' => 'required|exists:severity_levels,id',
            'report_date' => 'required|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'short_description' => 'required|string',

            'is_public' => 'nullable|boolean',
            'map_url' => 'nullable|url',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp3,wav,ogg,mp4|max:10240',
        ]);

        DB::beginTransaction();

        try {
            // Get the first status as default
            $firstStatus = ReportStatus::first();

            $validated['status_id'] = $firstStatus->id;
            $validated['is_public'] = $request->has('is_public') ? 1 : 0;

            // Create the report
            $report = Report::create($validated);

            // Handle file uploads
            if ($request->hasFile('attachments')) {
                $attachmentCount = 0;

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

                $report->update(['attachments_count' => $attachmentCount]);
            }

            // Create initial tracking record
            ReportTracking::create([
                'report_id' => $report->id,
                'status_id' => $firstStatus->id,
                'comment' => 'تم إنشاء البلاغ',
                'changed_by_admin_id' => auth()->id(),
                'created_at' => now(),
            ]);

            DB::commit();

            toast(__('back.report_created_successfully'), 'success');
            return redirect()->route('reports.show', $report->id);

        } catch (\Exception $e) {
            DB::rollBack();
            toast(__('back.error_occurred') . ': ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        if (!auth()->user()->can('show_report')) {
            abort(403);
        }

        $report->load([
            'employee',
            'location',
            'severityLevel',
            'status',
            'attachments',
            'trackings.status',
            'trackings.changedByAdmin',
            'trackings.changedByEmployee'
        ]);

        $reportStatuses = ReportStatus::all();

        return view('backend.pages.reports.show', compact('report', 'reportStatuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        if (!auth()->user()->can('edit_report')) {
            abort(403);
        }

        $locations = Location::where('status', 1)->get();
        $severityLevels = SeverityLevel::ordered()->get();
        $employees = Employee::where('status', 1)->get();
        $reportStatuses = ReportStatus::all();

        return view('backend.pages.reports.edit', compact(
            'report',
            'locations',
            'severityLevels',
            'employees',
            'reportStatuses'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        if (!auth()->user()->can('edit_report')) {
            abort(403);
        }

        $validated = $request->validate([
            'employee_id' => 'nullable|exists:employees,id',
            'location_id' => 'required|exists:locations,id',
            'severity_level_id' => 'required|exists:severity_levels,id',
            'report_date' => 'required|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'short_description' => 'required|string',
            'status_id' => 'required|exists:report_statuses,id',
            'is_public' => 'nullable|boolean',
            'map_url' => 'nullable|url',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp3,wav,ogg,mp4|max:10240',
        ]);

        DB::beginTransaction();

        try {
            $validated['is_public'] = $request->has('is_public') ? 1 : 0;

            $oldStatusId = $report->status_id;
            $report->update($validated);

            // Track status change
            if ($oldStatusId != $validated['status_id']) {
                ReportTracking::create([
                    'report_id' => $report->id,
                    'status_id' => $validated['status_id'],
                    'comment' => 'تم تحديث حالة البلاغ',
                    'changed_by_admin_id' => auth()->id(),
                    'created_at' => now(),
                ]);
            }

            // Handle new file uploads
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
                    $fileSize = $file->getSize() / 1048576;

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
                }

                $report->update(['attachments_count' => $report->attachments()->count()]);
            }

            DB::commit();

            toast(__('back.updated_successfully'), 'success');
            return redirect()->route('reports.show', $report->id);

        } catch (\Exception $e) {
            DB::rollBack();
            toast(__('back.error_occurred') . ': ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        if (!auth()->user()->can('delete_report')) {
            abort(403);
        }

        DB::beginTransaction();

        try {
            // Delete attachments from local storage
            foreach ($report->attachments as $attachment) {
                if (file_exists(public_path($attachment->file_path))) {
                    unlink(public_path($attachment->file_path));
                }
            }

            // Delete report (cascades will handle related records)
            $report->delete();

            DB::commit();

            toast(__('back.deleted_successfully'), 'success');
            return redirect()->route('reports.index');

        } catch (\Exception $e) {
            DB::rollBack();
            toast(__('back.error_occurred') . ': ' . $e->getMessage(), 'error');
            return back();
        }
    }

    /**
     * Change report status and add tracking.
     */
    public function changeStatus(Request $request, Report $report)
    {
        if (!auth()->user()->can('change_report_status')) {
            abort(403);
        }

        $validated = $request->validate([
            'status_id' => 'required|exists:report_statuses,id',
            'comment' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $report->update(['status_id' => $validated['status_id']]);

            ReportTracking::create([
                'report_id' => $report->id,
                'status_id' => $validated['status_id'],
                'comment' => $validated['comment'] ?? null,
                'changed_by_admin_id' => auth()->id(),
                'created_at' => now(),
            ]);

            // Send notification to employee
            if ($report->employee && $report->employee->email) {
                $report->load('status');
                $report->employee->notify(new ReportUpdatedNotification($report, $validated['comment'] ?? null));
            }

            DB::commit();

            toast(__('back.status_changed_successfully'), 'success');

            // Force page reload by redirecting to current URL with cache-busting parameter
            return redirect()->to(url()->previous() . '?_=' . time())
                ->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ]);

        } catch (\Exception $e) {
            DB::rollBack();
            toast(__('back.error_occurred') . ': ' . $e->getMessage(), 'error');
            return back();
        }
    }

    /**
     * Export reports to Excel.
     */
    public function export(Request $request)
    {
        if (!auth()->user()->can('export_report')) {
            abort(403);
        }

        $query = Report::with(['employee', 'location', 'severityLevel', 'status']);


        if ($request->filled('status_id')) {
            $query->byStatus($request->status_id);
        }

        if ($request->filled('severity_level_id')) {
            $query->bySeverity($request->severity_level_id);
        }

        if ($request->filled('location_id')) {
            $query->byLocation($request->location_id);
        }

        if ($request->filled('employee_id')) {
            $query->byEmployee($request->employee_id);
        }

        if ($request->filled('start_date') || $request->filled('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $reports = $query->latest()->get();

        // Use Laravel Excel or generate CSV
        // For now, return a simple CSV response
        $filename = 'reports_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($reports) {
            $file = fopen('php://output', 'w');

            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Add headers
            fputcsv($file, [
                'Report Number',
                'Date',
                'Employee',
                'department',
                'Location',
                'Severity',
                'Status',
                'Short Description',
                'Attachments',
            ]);

            foreach ($reports as $report) {
                fputcsv($file, [
                    $report->report_number,
                    $report->report_date->format('Y-m-d H:i'),
                    $report->employee?->name ?? '-',
                    $report->employee?->CategoryEmployees?->name ?? '-',
                    $report->location?->name ?? '-',
                    $report->severityLevel?->name ?? '-',
                    $report->status?->name ?? '-',
                    $report->short_description,
                    $report->attachments_count,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
