<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HR\Employee;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_number',
        'employee_id',
        'location_id',
        'severity_level_id',
        'report_date',
        'latitude',
        'longitude',
        'short_description',
        'status_id',
        'is_public',
        'map_url',
        'attachments_count',
    ];

    protected $casts = [
        'report_date' => 'datetime',
        'latitude' => 'decimal:3',
        'longitude' => 'decimal:3',
        'is_public' => 'boolean',
        'attachments_count' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($report) {
            if (empty($report->report_number)) {
                $report->report_number = static::generateReportNumber();
            }
        });
    }

    /**
     * Generate unique report number.
     */
    public static function generateReportNumber()
    {
        $date = date('Ymd');
        $lastReport = static::where('report_number', 'like', "REP-{$date}-%")
            ->orderBy('report_number', 'desc')
            ->first();

        if ($lastReport) {
            $lastNumber = (int) substr($lastReport->report_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return sprintf('REP-%s-%04d', $date, $newNumber);
    }

    /**
     * Get the employee that submitted the report.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }



    /**
     * Get the location of the report.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the severity level of the report.
     */
    public function severityLevel()
    {
        return $this->belongsTo(SeverityLevel::class);
    }

    /**
     * Get the status of the report.
     */
    public function status()
    {
        return $this->belongsTo(ReportStatus::class, 'status_id');
    }

    /**
     * Get all attachments for the report.
     */
    public function attachments()
    {
        return $this->hasMany(ReportAttachment::class);
    }

    /**
     * Get all trackings for the report.
     */
    public function trackings()
    {
        return $this->hasMany(ReportTracking::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get all messages for the report.
     */
    public function messages()
    {
        return $this->hasMany(ReportMessage::class)->orderBy('created_at', 'asc');
    }

    /**
     * Get localized short description based on current locale.
     */
    public function getShortDescriptionAttribute($value)
    {
        return $value;
    }

    /**
     * Get localized full description based on current locale.
     */
    /**
     * Scope to filter by status.
     */
    public function scopeByStatus($query, $statusId)
    {
        if ($statusId) {
            return $query->where('status_id', $statusId);
        }
        return $query;
    }

    /**
     * Scope to filter by severity level.
     */
    public function scopeBySeverity($query, $severityId)
    {
        if ($severityId) {
            return $query->where('severity_level_id', $severityId);
        }
        return $query;
    }

    /**
     * Scope to filter by location.
     */
    public function scopeByLocation($query, $locationId)
    {
        if ($locationId) {
            return $query->where('location_id', $locationId);
        }
        return $query;
    }

    /**
     * Scope to filter by employee.
     */
    public function scopeByEmployee($query, $employeeId)
    {
        if ($employeeId) {
            return $query->where('employee_id', $employeeId);
        }
        return $query;
    }

    /**
     * Scope to filter by date range.
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereBetween('report_date', [$startDate, $endDate]);
        } elseif ($startDate) {
            return $query->where('report_date', '>=', $startDate);
        } elseif ($endDate) {
            return $query->where('report_date', '<=', $endDate);
        }
        return $query;
    }

    /**
     * Scope to search in descriptions and report number.
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('report_number', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ;
            });
        }
        return $query;
    }
}
