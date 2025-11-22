<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Location;
use App\Models\SeverityLevel;
use App\Models\ReportStatus;
use Illuminate\Http\Request;

class DepartmentReportController extends Controller
{
    /**
     * Display a listing of department reports.
     */
    public function index(Request $request)
    {
        $employee = auth('employee')->user();
        $categoryEmployeesId = $employee->category_employees_id;

        // Get all reports from employees in the same department/category
        $query = Report::with(['employee', 'location', 'severityLevel', 'status'])
            ->whereHas('employee', function($q) use ($categoryEmployeesId) {
                $q->where('category_employees_id', $categoryEmployeesId);
            });

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('report_number', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }

        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->filled('severity_level_id')) {
            $query->where('severity_level_id', $request->severity_level_id);
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

        return view('Employee.department-reports.index', compact('reports', 'locations', 'severityLevels', 'reportStatuses'));
    }

    /**
     * Display the specified department report.
     */
    public function show($id)
    {
        $employee = auth('employee')->user();
        $categoryEmployeesId = $employee->category_employees_id;

        // Get report and verify it belongs to same department
        $report = Report::with([
            'employee.CategoryEmployees',
            'location',
            'severityLevel',
            'status',
            'attachments',
            'trackings.status',
            'trackings.changedByAdmin',
            'trackings.changedByEmployee'
        ])
        ->whereHas('employee', function($q) use ($categoryEmployeesId) {
            $q->where('category_employees_id', $categoryEmployeesId);
        })
        ->findOrFail($id);

        return view('Employee.department-reports.show', compact('report'));
    }
}
